<table>
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bold ">
            <th>#</th>
            <th>@lang('cms.name')</th>
            <th>@lang('cms.email')</th>
            <th>@lang('cms.role')</th>
            <th>@lang('cms.lastlogin')</th>
            <th>@lang('cms.is_active')</th>
            <th>@lang('cms.created_at')</th>
            <th>@lang('cms.updated_at')</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td >{{ $user->id }}</td>
                <td >{{ $user->name }}</td>
                <td >{{ $user->email }}</td>
                <td >{{ $user->phone }}</td>
                <td >{{ $user->roles->pluck('display_name')[0] }}</td>
                <td >{{ $user->is_active == 1 ? 'Aktif' : 'Pasif' }}</td>
                <td >{{ $user->last_seen }}</td>
                <td >{{ date('d.m.Y H:i:s',strtotime($user->created_at)) }}</td>
                <td >{{ date('d.m.Y H:i:s',strtotime($user->updated_at)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
