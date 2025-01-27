@extends('admins.dashboard')

@section('page-content')
<div class="container">
    <div class="ms-5">
        <div class="col-12 card align-items-center pt-4" style="height: 700px;">
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Company name</td>
                        <td>Kredo</td>
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
                        <td style="width: 150px;">email</td>
                        <td>krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Website</td>
                        <td>www.kredo.co.jp</i></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Company name</td>
                        <td>Kredo</td>
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
                        <td style="width: 150px;">email</td>
                        <td>krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Website</td>
                        <td>www.kredo.co.jp</i></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Company name</td>
                        <td>Kredo</td>
                        <td>
                        {{-- @if ($user->trashed())
                            <i class="fa-solid fa-circle text-secondary"></i>&nbsp; Inactive
                        @else --}}
                            <i class="fa-solid fa-circle text-danger"></i>&nbsp; Active
                        {{-- @endif --}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">email</td>
                        <td>krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Website</td>
                        <td>www.kredo.co.jp</i></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="col-10 card m-2">
                <table class="table table-borderless align-middle text-secondary my-2">
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Company name</td>
                        <td>Kredo</td>
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
                        <td style="width: 150px;">email</td>
                        <td>krd2025@kredo.co.jp</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="width: 150px;">Website</td>
                        <td>www.kredo.co.jp</i></td>
                        <td></td>
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