@extends('admins.dashboard')

@section('title', 'Statistics')

@section('page-content')
<main class="py-4">
    <div class="container">
        <h2>Statistics Overview</h2>

        <!-- 登録者数・プロジェクト数のグラフを横並びに -->
        <div class="d-flex justify-content-between">
            <div style="width: 48%;">
                <h4>Number of Registrations</h4>
                <canvas id="registrationsChart"></canvas>
            </div>
            <div style="width: 48%;">
                <h4>Number of Projects</h4>
                <canvas id="projectsChart"></canvas>
            </div>
        </div>

        <!-- スキルのグラフ（追加） -->
        <div class="mt-5">
            <h4>Most Required Skills</h4>
            <canvas id="skillsChart"></canvas>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 登録者数・プロジェクト数のデータ取得
        $.ajax({
            url: "{{ route('admin.statistics.data') }}",
            method: "GET",
            success: function (response) {
                console.log("取得データ:", response); // デバッグ用

                if (!response || !response.weeks) {
                    console.error("データが正しく取得できませんでした:", response);
                    return;
                }

                // 各キャンバスを取得
                const ctxRegistrations = document.getElementById('registrationsChart').getContext('2d');
                const ctxProjects = document.getElementById('projectsChart').getContext('2d');

                // 登録者数のグラフ
                new Chart(ctxRegistrations, {
                    type: 'line',
                    data: {
                        labels: response.weeks, // 週ごとのラベル
                        datasets: [{
                            label: 'Number of Registrations',
                            data: response.userCounts,
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.2)',
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMin: 0,
                                suggestedMax: Math.max(...response.userCounts) + 2
                            }
                        }
                    }
                });

                // プロジェクト数のグラフ
                new Chart(ctxProjects, {
                    type: 'line',
                    data: {
                        labels: response.weeks,
                        datasets: [{
                            label: 'Number of Projects',
                            data: response.projectCounts,
                            borderColor: 'green',
                            backgroundColor: 'rgba(0, 255, 0, 0.2)',
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMin: 0,
                                suggestedMax: Math.max(...response.projectCounts) + 2
                            }
                        }
                    }
                });

            },
            error: function (error) {
                console.error("データ取得エラー:", error);
            }
        });

        // スキルのデータ取得
        $.ajax({
            url: "{{ route('admin.statistics.skills') }}",
            method: "GET",
            success: function (response) {
                console.log("スキルデータ:", response); // デバッグ用

                if (!response || response.length === 0) {
                    console.error("スキルデータがありません。", response);
                    return;
                }

                const skillNames = response.map(skill => skill.name);
                const skillCounts = response.map(skill => skill.count);

                const ctxSkills = document.getElementById('skillsChart').getContext('2d');

                new Chart(ctxSkills, {
                    type: 'bar',
                    data: {
                        labels: skillNames,
                        datasets: [{
                            label: 'Number of Projects Requiring Each Skill',
                            data: skillCounts,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            },
            error: function (error) {
                console.error("スキルデータ取得エラー:", error);
            }
        });
    });
</script>
@endsection