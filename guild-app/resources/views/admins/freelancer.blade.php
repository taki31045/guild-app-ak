@extends('admins.dashboard')

@section('page-content')
<div class="container">
    <div class="card">
        <table class="table  align-middle border-none text-secondary">
            <tr>
                <td rowspan="4"><i class="fa-solid fa-circle-user icon-lg"></i></td>
                <td>name</td>
                <td>Ryunosuke</td>
                <td>
                {{-- @if ($user->trashed())
                    <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                @else --}}
                    <i class="fa-solid fa-circle text-primary"></i>&nbsp; Active
                {{-- @endif --}}
                </td>
            </tr>
            <tr>
                <td>email</td>
                <td>krd2025@kredo.co.jp</td>
                <td></td>
            </tr>
            <tr>
                <td>Evaluation:</td>
                <td><i class="fa-solid fa-star text-warning"></i></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"><button class="badge text-bg-secondary">PHP</button>&nbsp;<button class="badge text-bg-secondary">HTML</button>&nbsp;<button class="badge text-bg-secondary">CSS</button>&nbsp;<button class="badge text-bg-secondary">Javascript</button></td>
            </tr>
        </table>
    </div>
</div>
{{-- {{ $all_users->links() }} --}}
@endsection