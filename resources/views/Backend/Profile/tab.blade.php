<ul class="nav nav-tabs">
    <li><a href="{{route('generalProfile')}}">General Info</a></li>
    <li><a href="{{route('accountSettingProfile')}}" >Account Setting</a></li>
    @permission('view-social-link')
    <li><a href="{{route('socialLink')}}" >Social Links</a></li>
    @endpermission
</ul>