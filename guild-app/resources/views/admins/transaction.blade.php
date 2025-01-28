@extends('admins.dashboard')

@section('page-content')
  <!-- JOB No.1 -->
  <div class="job-container">
    <div class="job-header">JOB No.1</div>
    <div class="info">
      <span><strong>Company Name:</strong> kredo</span>
      <span><strong>Freelancer Name:</strong> Ryunosuke</span>
      <span class="mt-3"><strong>Transaction History</strong></span>
    </div>
    <table class="transaction-table">
      <thead>
        <tr>
          <th>DATE</th>
          <th>INCOME ($)</th>
          <th>EXPENSE ($)</th>
          <th>NOTES</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>01 Apr 2025</td>
          <td>1,100</td>
          <td></td>
          <td>From Company (commission Fee Included)</td>
        </tr>
        <tr>
          <td>28 Apr 2025</td>
          <td></td>
          <td>1,000</td>
          <td>To Freelancer</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- JOB No.2 -->
  <div class="job-container">
    <div class="job-header">JOB No.2</div>
    <div class="info">
      <span><strong>Company Name:</strong> kredo</span>
      <span><strong>Freelancer Name:</strong> Kenta</span>
      <span class="mt-3"><strong>Transaction History</strong></span>
    </div>
    <table class="transaction-table">
      <thead>
        <tr>
          <th>DATE</th>
          <th>INCOME ($)</th>
          <th>EXPENSE ($)</th>
          <th>NOTES</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>01 May 2025</td>
          <td>2,200</td>
          <td></td>
          <td>From Company (commission Fee Included)</td>
        </tr>
        <tr>
          <td>14 May 2025</td>
          <td></td>
          <td>2,000</td>
          <td>To Freelancer</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Total Balance -->
  <div class="total-balance">TOTAL BALANCE: $300</div>

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