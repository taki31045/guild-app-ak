@extends('admins.dashboard')

@section('page-content')
<div class="container">
    <div class="ms-5">
        <div class="col-12 card align-items-center pt-4" style="height: 700px;">
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td rowspan="4"  style="width: 150px;"><i class="fa-solid fa-circle-user icon-lg"></i></td>
                        <td style="width: 100px;">name</td>
                        <td style="width: 200px;">Ryunosuke</td>
                        <td>
                        {{-- @if ($user->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        @else --}}
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; Active
                        {{-- @endif --}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">email</td>
                        <td style="width: 200px;">krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Evaluation:</td>
                        <td style="width: 200px;"><i class="fa-solid fa-star text-warning"></i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" style="width: 50px;"><button class="badge text-bg-secondary">PHP</button>&nbsp;<button class="badge text-bg-secondary">HTML</button>&nbsp;<button class="badge text-bg-secondary">CSS</button>&nbsp;<button class="badge text-bg-secondary">Javascript</button></td>
                    </tr>
                </table>
            </div>
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td rowspan="4"  style="width: 150px;"><i class="fa-solid fa-circle-user icon-lg"></i></td>
                        <td style="width: 100px;">name</td>
                        <td style="width: 200px;">Ryunosuke</td>
                        <td>
                        {{-- @if ($user->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        @else --}}
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; Active
                        {{-- @endif --}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">email</td>
                        <td style="width: 200px;">krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Evaluation:</td>
                        <td style="width: 200px;"><i class="fa-solid fa-star text-warning"></i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" style="width: 50px;"><button class="badge text-bg-secondary">PHP</button>&nbsp;<button class="badge text-bg-secondary">HTML</button>&nbsp;<button class="badge text-bg-secondary">CSS</button>&nbsp;<button class="badge text-bg-secondary">Javascript</button></td>
                    </tr>
                </table>
            </div>
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td rowspan="4"  style="width: 150px;"><i class="fa-solid fa-circle-user icon-lg"></i></td>
                        <td style="width: 100px;">name</td>
                        <td style="width: 200px;">Ryunosuke</td>
                        <td>
                        {{-- @if ($user->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        @else --}}
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; Active
                        {{-- @endif --}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">email</td>
                        <td style="width: 200px;">krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 100px;">Evaluation:</td>
                        <td style="width: 200px;"><i class="fa-solid fa-star text-warning"></i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="3" style="width: 50px;"><button class="badge text-bg-secondary">PHP</button>&nbsp;<button class="badge text-bg-secondary">HTML</button>&nbsp;<button class="badge text-bg-secondary">CSS</button>&nbsp;<button class="badge text-bg-secondary">Javascript</button></td>
                    </tr>
                </table>
            </div>  
        </div>
    </div>
</div>
{{-- {{ $all_users->links() }} --}}
<!-- Pagination -->
<div class="pagination">
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <span>...</span>
    <a href="#">67</a>
    <a href="#">68</a>
  </div>
@endsection