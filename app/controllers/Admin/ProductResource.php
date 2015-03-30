<?php

class Admin_ProductResource extends BaseResource
{
    /**
     * 资源视图目录
     * @var string
     */
    protected $resourceView = 'admin.product';

    /**
     * 资源模型名称，初始化后转为模型实例
     * @var string|Illuminate\Database\Eloquent\Model
     */
    protected $model = 'Product';

    /**
     * 资源标识
     * @var string
     */
    protected $resource = 'product';

    /**
     * 资源数据库表
     * @var string
     */
    protected $resourceTable = 'product';

    /**
     * 资源名称（中文）
     * @var string
     */
    protected $resourceName = '产品';

    /**
     * 自定义验证消息
     * @var array
     */
    protected $validatorMessages = array(
        'title.required'      => '请输入标题。',
        'title.between'       => '标题字数必须在:min和:max之间。',
        'price.required'      => '请填写价格',
        'price.numeric'       => '价格格式不正确，必须为数字',
        'code.required'       => '请输入编码。',
        'code.unique'         => '此编码已被使用。',
        'code.between'        => '编码长度在:min和:max之间',
        'code.alpha_num'      => '编码只允许字母和数字',
        'varietieId.required' => '请选择鹦鹉品种。',
        'varietieId.min'      => '请选择鹦鹉品种。',
    );


    public function create()
    {
        $varieties = array_merge(['请选择'], Varietie::lists('name', 'id'));
        return View::make($this->resourceView . '.create')->with(compact('varieties'));
    }

    /**
     * 资源列表页面
     * GET         /resource
     * @return Response
     */
    public function index()
    {
        // 获取排序条件
        $orderBy = Input::get('sort_asc', Input::get('sort_desc', 'created_at'));

        $sort         = Input::get('sort_asc') ? 'asc' : 'desc';
        $title        = Input::get('keyword') ? Input::get('keyword') : NULL;
        $varietieId   = Input::get('varietieId') ? Input::get('varietieId') : NULL;
        $priceFrom    = Input::get('priceFrom') ? Input::get('priceFrom') : NULL;
        $priceTo      = Input::get('priceTo') ? Input::get('priceTo') : NULL;


        $birthday = $this->model->age_to_date(Input::get('ageY',0),Input::get('ageM',0),Input::get('ageD',0));


        // 获取搜索条件
        // 构造查询语句
        $query = $this->model->orderBy($orderBy, $sort);

        //TODO 目前只支持匹配标题，需要加上匹配编号的功能
        isset($varietieId   )    AND $query->where('varietieId',        $varietieId     );
        isset($title        )    AND $query->where('title',     'like', "%{$title}%"    );
        isset($priceFrom    )    AND $query->where('price',     '>=',    $priceFrom      );
        isset($priceTo      )    AND $query->where('price',     '<=',    $priceTo        );
        if($birthday        )        $query->where('birthday',  '>=',    $birthday       );


        $datas     = $query->paginate(10);
        $varieties = array_merge(['请选择'], Varietie::lists('name', 'id'));
        return View::make($this->resourceView . '.index')->with(compact('datas', 'varieties'));
    }

    /**
     * 资源创建动作
     * POST        /resource
     * @return Response
     */
    public function store()
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $unique = $this->unique();
        $rules  = array(
            'title'      => 'required|between:5,30|' . $unique,
            'code'       => 'required|alpha_dash|between:3,10|' . $unique,
            'varietieId' => 'required|min:1',
            'price'      => 'required|numeric',
            'birthday'   => 'required|date_format:Y-m-d'
        );
        // 自定义验证消息
        // 开始验证
        $validator = Validator::make($data, $rules, $this->validatorMessages);
        if ($validator->passes()) {
            // 验证成功
            // 添加资源
            $model               = $this->model;
            $model->title        = Input::get('title');
            $model->code         = Input::get('code');
            $model->price        = floatval(Input::get('price'));
            $model->varietieId   = intval(Input::get('varietieId'));
            $model->birthday     = Input::get('birthday');
            $model->faVarietie   = Input::get('faVarietie');
            $model->maVarietie   = Input::get('maVarietie');
            $model->dominantGene = Input::get('dominantGene');
            $model->implicitGene = Input::get('implicitGene');
            $model->description  = Input::get('description', '');
            $model->created_at   = new Carbon;
            if ($model->save()) {
                // 添加成功
                return Redirect::back()
                    ->with('success', '<strong>' . $this->resourceName . '添加成功：</strong>您可以继续添加新' . $this->resourceName . '，或返回' . HTML::link(route('product.index', $this->resourceName . '列表')));
            } else {
                // 添加失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>' . $this->resourceName . '添加失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }

    /**
     * 资源编辑动作
     * PUT/PATCH   /resource/{id}
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        // 获取所有表单数据.
        $data = Input::all();
        // 创建验证规则
        $rules = array(
            'email'    => 'required|email|' . $this->unique('email', $id),
            'password' => 'alpha_dash|between:6,16|confirmed',
            'is_admin' => 'in:1',
        );
        // 自定义验证消息
        $messages = $this->validatorMessages;
        // 开始验证
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->passes()) {
            // 验证成功
            // 更新资源
            $model           = $this->model->find($id);
            $model->email    = Input::get('email');
            $model->is_admin = (int)Input::get('is_admin', 0);
            if ($model->save()) {
                // 更新成功
                return Redirect::back()
                    ->with('success', '<strong>' . $this->resourceName . '更新成功：</strong>您可以继续编辑' . $this->resourceName . '，或返回' . $this->resourceName . '列表。');
            } else {
                // 更新失败
                return Redirect::back()
                    ->withInput()
                    ->with('error', '<strong>' . $this->resourceName . '更新失败。</strong>');
            }
        } else {
            // 验证失败
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }


}
