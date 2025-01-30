@extends('layouts.app')

@section('title', 'Evaluation')

@section('content')
    <div class="content">
         <h1>Evaluation</h1>

         <div>
            <label for="customRange6" class="form-label">
                Example range: <span id="rangeValue">50</span>
            </label>
            <input type="range" class="form-range" id="customRange6" min="0" max="100" value="50" oninput="updateRangeValue(this.value)">
        </div>
        
        <script>
            function updateRangeValue(value) {
                document.getElementById("rangeValue").textContent = value;
            }
        </script>
        
    </div>
@endsection