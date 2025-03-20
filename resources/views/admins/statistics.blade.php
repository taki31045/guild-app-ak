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

        <!-- スキルのグラフを横並びで追加 -->
        <div class="d-flex justify-content-between mt-5">
            <div style="width: 48%;">
                <h4>Project Skills Trends</h4>
                <canvas id="projectSkillsChart"></canvas>
            </div>
            <div style="width: 48%;">
                <h4>Freelancer Skills Trends</h4>
                <canvas id="freelancerSkillsChart"></canvas>
            </div>
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
                if (!response || !response.weeks) {
                    console.error("データが正しく取得できませんでした:", response);
                    return;
                }

                const ctxRegistrations = document.getElementById('registrationsChart').getContext('2d');
                const ctxProjects = document.getElementById('projectsChart').getContext('2d');

                // 登録者数のグラフ
                new Chart(ctxRegistrations, {
                    type: 'line',
                    data: {
                        labels: response.weeks,
                        datasets: [{
                            label: 'Number of Registrations',
                            data: response.userCounts,
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.2)',
                            fill: true
                        }]
                    },
                    options: { responsive: true, scales: { y: { beginAtZero: true } } }
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
                    options: { responsive: true, scales: { y: { beginAtZero: true } } }
                });

            },
            error: function (error) { console.error("データ取得エラー:", error); }
        });

        // プロジェクトのスキル推移グラフ
        $.ajax({
            url: "{{ route('admin.statistics.skills') }}",
            method: "GET",
            success: function (response) {
                if (!response || response.length === 0) {
                    console.error("スキルデータがありません。", response);
                    return;
                }

                const weeks = response.weeks;
                const datasets = response.skills.map(skill => ({
                    label: skill.name,
                    data: skill.weekly_counts,
                    borderColor: getRandomColor(),
                    fill: false
                }));

                new Chart(document.getElementById('projectSkillsChart').getContext('2d'), {
                    type: 'line',
                    data: { labels: weeks, datasets },
                    options: { responsive: true, scales: { y: { beginAtZero: true } } }
                });
            },
            error: function (error) { console.error("スキルデータ取得エラー:", error); }
        });

        // フリーランサーのスキル推移グラフ
        $.ajax({
            url: "{{ route('admin.statistics.freelancer_skills') }}",
            method: "GET",
            success: function (response) {
                if (!response || response.length === 0) {
                    console.error("フリーランサースキルデータがありません。", response);
                    return;
                }

                const weeks = response.weeks;
                const datasets = response.skills.map(skill => ({
                    label: skill.name,
                    data: skill.weekly_counts,
                    borderColor: getRandomColor(),
                    fill: false
                }));

                new Chart(document.getElementById('freelancerSkillsChart').getContext('2d'), {
                    type: 'line',
                    data: { labels: weeks, datasets },
                    options: { responsive: true, scales: { y: { beginAtZero: true } } }
                });
            },
            error: function (error) { console.error("フリーランサースキルデータ取得エラー:", error); }
        });

        // ランダムな色を生成する関数
        function getRandomColor() {
            return `hsl(${Math.random() * 360}, 70%, 50%)`;
        }
    });
</script>
@endsection