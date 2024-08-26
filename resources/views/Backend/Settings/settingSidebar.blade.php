<div class="col-md-2">
    <ul class="products-list settingSidebar">

        @permission('view-general-setting')
        <li>
            <a href="{{route('generalSetting')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">General</h4>
                </div>
            </a>
        </li>
        @endpermission

        @permission('view-company-setting')
        <li>
            <a href="{{route('companySetting')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">Company</h4>
                </div>
            </a>
        </li>
        @endpermission

        @permission('view-email-setting')
        <li>
            <a href="{{route('emailSetting')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">Email</h4>
                </div>
            </a>
        </li>
        @endpermission

        @permission('view-country')
        <li>
            <a href="{{route('countries')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">Countries</h4>
                </div>
            </a>
        </li>
        @endpermission


        @permission('view-state')
        <li>
            <a href="{{route('states')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">States</h4>
                </div>
            </a>
        </li>
        @endpermission

        @permission('view-permission')
        <li>
            <a href="{{route('permission')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">Permission</h4>
                </div>
            </a>
        </li>
        @endpermission

        @permission('view-role')
        <li>
            <a href="{{route('role')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">Role</h4>
                </div>
            </a>
        </li>
        @endpermission

        @permission('view-tax')
        <li>
            <a href="{{route('tax')}}">
                <div class="box-header with-border">
                    <h4 class="box-title">Taxes</h4>
                </div>
            </a>
        </li>
        @endpermission




    </ul>
</div>