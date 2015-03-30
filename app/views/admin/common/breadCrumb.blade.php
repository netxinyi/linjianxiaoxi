
@if(isset($breadCrumb) && is_array($breadCrumb))
     <div>
            <ul class="breadcrumb">
                   @foreach($breadCrumb as $title => $url)
                        <li>
                            <a href="{{$url}}">{{$title}}</a>
                        </li>
                   @endforeach
            </ul>
        </div>
@endif
