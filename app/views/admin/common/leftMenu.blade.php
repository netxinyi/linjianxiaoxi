 <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="{{route('admin.index')}}"><span> 首页</span></a>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span>鹦鹉管理</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{route('product.index')}}">鹦鹉列表</a></li>
                                <li><a href="{{route('product.create')}}">添加鹦鹉</a></li>
                                <li><a href="/product/gallery">相册管理</a></li>
                            </ul>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span>品种管理</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="{{route('varietie.index')}}">品种列表</a></li>
                                <li><a href="{{route('varietie.create')}}">添加品种</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- left menu ends -->
