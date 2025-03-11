@extends('layouts.company')

@section('title', 'Evaluation')

@section('content')
<style>
    body {
        background-color: #f4f4f9; 
        overflow: hidden;
    }

    .range-container {
        position: relative;
        width: 300px;
        text-align: center;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 40px;
        margin-left: 39%;
        transition: transform 0.3s ease;
    }

    .range-container:hover {
        transform: translateY(-5px);
    }

    .range-label {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
        font-weight: bold;
    }

    .range-wrapper {
        position: relative;
        width: 100%;
    }

    .range-value {
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-50%);
        background: purple;
        color: white;
        padding: 5px 12px;
        border-radius: 50%;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    input[type="range"] {
        width: 100%;
        appearance: none;
        height: 10px;
        background: #ddd;
        border-radius: 5px;
        outline: none;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    input[type="range"]:hover {
        background: #ccc;
    }

    /* Customizing the thumb (slider circle) */
    input[type="range"]::-webkit-slider-thumb {
        appearance: none;
        width: 24px;
        height: 24px;
        background: purple;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    /* Styling for Firefox */
    input[type="range"]::-moz-range-thumb {
        width: 24px;
        height: 24px;
        background: purple;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    /* Focus styles */
    input[type="range"]:focus {
        outline: none;
        background: #bbb;
    }

    input[type="range"]:focus + .range-value {
        display: block;
    }

    /* Button Styling */
    .bun {
        background: #6f42c1;
        color: white;
        font-size: 18px;
        font-weight: bold;
        padding: 12px 30px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        text-align: center;
        display: block;
        width: 200px; /* Set width of button */
        float: right;
    }

    .bun:hover {
        background: #5a2b8c;
        transform: translateY(-3px);
    }

    .bun:active {
        transform: translateY(1px);
    }

    .bun:focus {
        outline: none;
    }

</style>
<div class="mt-5">
    <h1>Evaluation</h1>

    <form action="{{ route('company.evaluation.store')}}" method="post">
        @csrf
        <div class="range-container">
            <div class="range-wrapper">
                <input type="range" name="quality" class="form-range" id="customRange1" min="0" max="10" value="5" oninput="rangeValue1.textContent = this.value">
                <span class="range-value" id="rangeValue1">5</span>
            </div>
            <label class="range-label">quality</label>
        </div>
        
        <div class="range-container">
            <div class="range-wrapper">
                <input type="range" name="communication" class="form-range" id="customRange2" min="0" max="10" value="5" oninput="rangeValue2.textContent = this.value">
                <span class="range-value" id="rangeValue2">5</span>
            </div>
            <label class="range-label">communication</label>
        </div>
        
        <div class="range-container">
            <div class="range-wrapper">
                <input type="range" name="adherence" class="form-range" id="customRange3" min="0" max="10" value="5" oninput="rangeValue3.textContent = this.value">
                <span class="range-value" id="rangeValue3">5</span>
            </div>
            <label class="range-label">adherence</label>
        </div>
        
        <div class="range-container">
            <div class="range-wrapper">
                <input type="range" name="total" class="form-range" id="customRange4" min="0" max="10" value="5" oninput="rangeValue4.textContent = this.value">
                <span class="range-value" id="rangeValue4">5</span>
            </div>
            <label class="range-label">total</label>
        </div>

        <!-- Updated button placed below -->
        <button type="submit" class="bun">
            Next
        </button>
    </form>
</div>

@endsection
