<?php

/*
|--------------------------------------------------------------------------
| 基础权限
|--------------------------------------------------------------------------
*/
RouteGroup::make('auth')->before('guest')->controller('AuthorityController')->go(function ($route) {

    # 退出
    $route->get('logout')->as('logout')->uses('getLogout')->beforeClear();

    # 登录
    $route->get( 'signin'                   )->as('signin'        )->uses('getSignin'         );
    $route->post('signin'                   )                      ->uses('postSignin'        );
    # 注册
    $route->get( 'signup'                   )->as('signup'        )->uses('getSignup'         );
    $route->post('signup'                   )                      ->uses('postSignup'        );
    # 注册成功提示用户激活
    $route->get( 'success/{email}'          )->as('signupSuccess' )->uses('getSignupSuccess'  );
    # 激活账号
    $route->get( 'activate/{activationCode}')->as('activate'      )->uses('getActivate'       );
    # 忘记密码
    $route->get( 'forgot-password'          )->as('forgotPassword')->uses('getForgotPassword' );
    $route->post('forgot-password'          )                      ->uses('postForgotPassword');
    # 密码重置
    $route->get( 'forgot-password/{token}'  )->as('reset'         )->uses('getReset'          );
    $route->post('forgot-password/{token}'  )                      ->uses('postReset'         );

});

/*
|--------------------------------------------------------------------------
| 管理员后台
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function () {

    # 后台首页
    RouteGroup::make()->controller('AdminController')->go(function ($route) {
        $route->get('/')->as('admin')->uses('getIndex');
    });

    # 鹦鹉管理
    RouteGroup::make('product')->as('product')->controller('Admin_ProductResource')->go(function ($route) {
        $route->index( )
              ->create()
              ->store( )
              ->edit(  )
              ->update();
        $route->get('gallery')->as('gallery')->uses('galleryIndex');
        $route->post('uploadImg')->as('uploadImg')->uses('uploadImg');


        $route->delete('{id}')->as('destroy')->uses('destroy');
    });

    # 品种管理
    RouteGroup::make('varietie')->as('varietie')->controller('Admin_VarietieResource')->go(function ($route) {
        $route->index( )
              ->create()
              ->store( )
              ->edit(  )
              ->update();
        $route->delete('{id}')->as('destroy')->uses('destroy');
    });



    # 用户管理
    RouteGroup::make('users')->as('users')->controller('Admin_UserResource')->go(function ($route) {
        $route->index( )
              ->create()
              ->store( )
              ->edit(  )->before('not.self')
              ->update()->before('not.self');
        $route->delete('{id}')->as('destroy')->uses('destroy')->before('not.self');
    });

    # 文章分类管理
    RouteGroup::make('categories')->as('categories')->controller('Admin_CategoryResource')->go(function ($route) {
        $route->index( )
              ->create()
              ->store( )
              ->edit(  )
              ->update();
        $route->delete('{id}')->as('destroy')->uses('destroy');
    });

    # 文章管理
    RouteGroup::make('articles')->as('articles')->controller('Admin_ArticleResource')->go(function ($route) {
        $route->index( )
              ->create()
              ->store( )
              ->edit(  )
              ->update();
        $route->delete('{id}')->as('destroy')->uses('destroy');
    });

    #工具
    RouteGroup::make('tools')->as('tools')->controller('Admin_ToolsController')->go(function ($route) {
        $route->index();
        $route->get('payLink')->as('payLink')->uses('showPayLink');
        $route->post('payLink')->as('doPayLink')->uses('doPayLink')->befor('csrf');
    });

});


/*
|--------------------------------------------------------------------------
| 用户中心
|--------------------------------------------------------------------------
*/
RouteGroup::make('account')->as('account')->before('auth')->controller('AccountController')->go(function ($route) {

    # 用户中心首页
    $route->get(   '/'               )->as('index'             )->uses('getIndex'         );
    # 修改当前账号密码
    $route->get(   'change-password' )->as('changePassword'    )->uses('getChangePassword');
    $route->put(   'change-password' )                          ->uses('putChangePassword');
    # 更改头像
    $route->get(   'change-portrait' )->as('changePortrait'    )->uses('getChangePortrait');
    $route->put(   'change-portrait' )                          ->uses('putChangePortrait');
    # 我的评论管理
    $route->get(   'my-comments'     )->as('myComments'        )->uses('getMyComments'    );
    $route->delete('my-comments/{id}')->as('myComments.destroy')->uses('deleteMyComment'  );

});

/*
|--------------------------------------------------------------------------
| 前台
|--------------------------------------------------------------------------
*/
Route::get('/',function(){
    return View::make('slidefolio');
});

Route::post('/doMessage',array('as'=>'doMessage','befor'=>'csrf','uses'=>'IndexController@doMessage'));




/*
|--------------------------------------------------------------------------
| 博客
|--------------------------------------------------------------------------
*/
RouteGroup::make()->controller('BlogController')->go(function ($route) {

    # 博客首页
    //$route->get( '/'            )->as('home'            )->uses('getIndex'           );
    # 分类文章列表
    $route->get( 'category/{id}')->as('categoryArticles')->uses('getCategoryArticles');
    # 展示博客文章
    $route->get( '{slug}'       )->as('blog.show'       )->uses('getBlogShow'        );
    # 提交文章评论
    $route->post('{slug}'       )                        ->uses('postBlogComment'    )->before('auth');

})/*->ddAll()*/;

/*
|--------------------------------------------------------------------------
| 特殊功能
|--------------------------------------------------------------------------
*/
Route::group(array('prefix' => 'tools'), function () {


});
