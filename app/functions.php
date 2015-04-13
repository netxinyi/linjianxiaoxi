<?php

/*
|--------------------------------------------------------------------------
| 复写官方函数
|--------------------------------------------------------------------------
|
| 官方函数库路径
| Illuminate/Support/helpers.php
|
*/

if (! function_exists('route')) {
    /**
     * Generate a URL to a named route.
     *
     * @param  string  $route
     * @param  string  $parameters
     * @return string
     */
    function route($route, $parameters = array())
    {
        if (Route::getRoutes()->hasNamedRoute($route))
            return app('url')->route($route, $parameters);
        else
            return 'javascript:void(0)';
    }
}

if (! function_exists('link_to_route')) {
    /**
     * Generate a HTML link to a named route.
     *
     * @param  string  $name
     * @param  string  $title
     * @param  array   $parameters
     * @param  array   $attributes
     * @return string
     */
    function link_to_route($name, $title = null, $parameters = array(), $attributes = array())
    {
        if (Route::getRoutes()->hasNamedRoute($name))
            return app('html')->linkRoute($name, $title, $parameters, $attributes);
        else
            return '<a href="javascript:void(0)"'.HTML::attributes($attributes).'>'.$name.'</a>';
    }
}


/*
|--------------------------------------------------------------------------
| 延伸自拓展配置文件
|--------------------------------------------------------------------------
|
*/

if (! function_exists('style')) {
    /**
     * 样式别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @param  dynamic  mixed  配置文件中的别名
     * @return string
     */
    function style()
    {
        $cssAliases = Config::get('extend.cssAliases');
        $styleArray = array_map(function ($aliases) use ($cssAliases) {
            if (isset($cssAliases[$aliases]))
                return HTML::style($cssAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($styleArray));
    }
}

if (! function_exists('script')) {
    /**
     * 脚本别名加载（支持批量加载，后期可拓展为自动多文件压缩合并）
     * @param  dynamic  mixed  配置文件中的别名
     * @return string
     */
    function script()
    {
        $jsAliases   = Config::get('extend.jsAliases');
        $scriptArray = array_map(function ($aliases) use ($jsAliases) {
            if (isset($jsAliases[$aliases]))
                return HTML::script($jsAliases[$aliases]);
        }, func_get_args());
        return implode('', array_filter($scriptArray));
    }
}


/*
|--------------------------------------------------------------------------
| 自定义核心函数
|--------------------------------------------------------------------------
|
*/

if (! function_exists('l')) {
    /**
     * 辅助调试函数
     * @param  dynamic  mixed
     * @return void
     */
    function l()
    {
        // 被调用记录
        $backtrace = debug_backtrace();
        $content   = $_SERVER['REQUEST_URI'].PHP_EOL;
        $content  .= '  断点位置 => '.$backtrace[0]['file'].':'.$backtrace[0]['line'].PHP_EOL;
        $content  .= '  调试内容 => '.var_export($backtrace[0]['args'], true).PHP_EOL;
        // 写入日志
        Log::debug($content);
    }
}

if (! function_exists('log_sql')) {
    /**
     * 将 SQL 执行记录写入调试日志
     * @return void
     */
    function log_sql()
    {
        $sqlList = DB::getQueryLog();
        $sqlLog  = '';
        foreach ($sqlList as $sql) {
            foreach (explode('?', $sql['query']) as $key => $value) {
                $sqlLog .= isset($sql['bindings'][$key])
                    ? $value.$sql['bindings'][$key]
                    : $value;
            }
            $sqlLog .= PHP_EOL.PHP_EOL;
        }
        // 被调用记录
        $backtrace = debug_backtrace();
        $content   = $_SERVER['REQUEST_URI'].PHP_EOL.PHP_EOL;
        $content  .= '断点位置 => '.$backtrace[0]['file'].':'.$backtrace[0]['line'].PHP_EOL.PHP_EOL;
        // 写入日志
        Log::debug($content.$sqlLog);
    }
}

if (! function_exists('define_array')) {
    /**
     * 批量定义常量
     * @param  array  $define 常量和值的数组
     * @return void
     */
    function define_array($define = array())
    {
        foreach ($define as $key => $value)
            defined($key) OR define($key, $value);
    }
}

if (! function_exists('friendly_date')) {
    /**
     * 友好的日期输出
     * @param  string|\Carbon\Carbon $theDate 待处理的时间字符串 | \Carbon\Carbon 实例
     * @return string                         友好的时间字符串
     */
    function friendly_date($theDate)
    {
        // 获取待处理的日期对象
        if (! $theDate instanceof \Carbon\Carbon)
            $theDate = \Carbon\Carbon::createFromTimestamp(strtotime($theDate));
        // 取得英文日期描述
        $friendlyDateString = $theDate->diffForHumans(\Carbon\Carbon::now());
        // 本地化
        $friendlyDateArray  = explode(' ', $friendlyDateString);
        $friendlyDateString = $friendlyDateArray[0]
            .Lang::get('friendlyDate.'.$friendlyDateArray[1])
            .Lang::get('friendlyDate.'.$friendlyDateArray[2]);
        // 数据返回
        return $friendlyDateString;
    }
}

if (! function_exists('pagination')) {
    /**
     * 拓展分页输出，支持临时指定分页模板
     * @param  Illuminate\Pagination\Paginator $paginator 分页查询结果的最终实例
     * @param  string                          $viewName  分页视图名称
     * @return \Illuminate\View\View
     */
    function pagination(Illuminate\Pagination\Paginator $paginator, $viewName = null)
    {
        $viewName = $viewName ?: Config::get('view.pagination');
        $paginator->getEnvironment()->setViewName($viewName);
        return $paginator->links();
    }
}

if (! function_exists('strip')) {
    /**
     * 反引用一个经过 e（htmlentities）和 addslashes 处理的字符串
     * @param  string $string 待处理的字符串
     * @return 转义后的字符串
     */
    function strip($string)
    {
        return stripslashes(HTML::decode($string));
    }
}


/*
|--------------------------------------------------------------------------
| 公共函数库
|--------------------------------------------------------------------------
|
*/

if (! function_exists('close_tags')) {
    /**
     * 闭合 HTML 标签 （此函数仍存在缺陷，无法处理不完整的标签，暂无更优方案，慎用）
     * @param  string $html HTML 字符串
     * @return string
     */
    function close_tags($html)
    {
        // 不需要补全的标签
        $singleTags = array('meta', 'img', 'br', 'link', 'area');
        // 匹配开始标签
        preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedTags = array_filter(array_reverse($result[1]), function ($tag) use ($singleTags) {
            if (! in_array($tag, $singleTags)) return $tag;
        });
        // 匹配关闭标签
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedTags = $result[1];
        // 开始补全
        foreach ($openedTags as $value) {
            if (in_array($value, $closedTags)) {
                unset($closedTags[array_search($value, $closedTags)]);
            } else {
                $html .= '</'.$value.'>';
            }
        }
        return $html;
    }
}

if (! function_exists('order_by')) {
    /**
     * 用于资源列表的排序标签
     * @param  string $columnName 列名
     * @param  string $default    是否默认排序列，up 默认升序 down 默认降序
     * @return string             a 标签排序图标
     */
    function order_by($columnName = '', $default = null)
    {
        $sortColumnName = Input::get('sort_asc', Input::get('sort_desc', false));
        if (Input::get('sort_asc')) {
            $except = 'sort_asc'; $orderType = 'sort_desc';
        } else {
            $except = 'sort_desc' ; $orderType = 'sort_asc';
        }


        if ($sortColumnName == $columnName) {
            $parameters = array_merge(Input::except($except), array($orderType => $columnName));
            $icon       = Input::get('sort_asc') ? 'chevron-up' : 'chevron-down' ;
        } elseif ($sortColumnName === false && $default == 'asc') {
            $parameters = array_merge(Input::all(), array('sort_desc' => $columnName));
            $icon       = 'chevron-up';
        } elseif ($sortColumnName === false && $default == 'desc') {
            $parameters = array_merge(Input::all(), array('sort_asc' => $columnName));
            $icon       = 'chevron-down';
        } else {
            $parameters = array_merge(Input::except($except), array('sort_asc' => $columnName));
            $icon       = 'random';
        }

        $a  = '<a href="';
        $a .= action(Route::current()->getActionName(), $parameters);
        $a .= '"><i class="glyphicon glyphicon-'.$icon.'" style="font-size:8px;color:#888888"></i></a>';
        return $a;
    }
}

if(! function_exists('date_to_age')){
    function date_to_age($diff,$befor = '', $after = ''){
        $str = '';
        if($diff <= 60){
            $str = $diff.'秒';
        }elseif($diff > 60 && $diff <= 3600){
            $str = floor($diff / 60).'分钟';
        }elseif($diff > 3600 && $diff <= 86400){

            $str = floor($diff / 3600).'小时';

        }elseif($diff > 86400 && $diff <= 2592000){
            $days = floor($diff / 86400);
            $str = $days.'天';

        }elseif($diff > 2592000 && $diff <= 31536000){
            $months = floor($diff / 2592000);
            $diff = $diff % 2592000;
            $str = $months.'个月'.date_to_age($diff);
        }elseif($diff > 31536000){
            $years = floor($diff / 31536000) ;
            $diff = $diff % 31536000 ;
            $str = $years.'年'.date_to_age($diff);
        }
        return $befor.$str.$after;
    }
}
if(! function_exists('imgurl_by_path')){
    function imgurl_by_path($path,$fileFullName,$size = ''){
        if(!$size){
            $fileName = $fileFullName;
        }else{
            $fileInfo = explode('.', $fileFullName);
            if(!$fileInfo){
                return false;
            }
            $fileName = $fileInfo[0].(!empty($size) ? '_'.$size.'.'.$fileInfo[1] : '.'.$fileInfo[1]);
        }

        $path = preg_replace('/(.*?\/?public)/','',$path);

        return URL::to(trim($path,'/').'/'.$fileName);
    }
}
if(! function_exists('imgurl_by_name')){
    function imgurl_by_name($fileFullName,$size = '',$default = ''){
        $fileInfo = explode('.', $fileFullName);
        if($file = explode('#^_^#',base64_decode($fileInfo[0]))){
            $targetFolder = date('Y-m',$file[1]);
            $filePath =  public_path('uploads/images/'.$targetFolder.'/');
            return imgurl_by_path($filePath,$fileFullName,$size) ?: $default;
        }
        return $default;
    }
}