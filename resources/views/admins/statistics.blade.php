@extends('admins.dashboard')

@section('title', 'Statistics')

@section('page-content')
<main class="py-4">
    <div class="container">
        <h2>Statistics Overview</h2>

        <!-- 1段目：登録者数の週間推移 -->
        <div class="d-flex justify-content-between">
            <div style="width: 48%;">
                <h4>Number of Registrations</h4>
                <canvas id="registrationsChart"></canvas>
            </div>
        </div>

        <!-- 2段目：新規登録プロジェクト数の週間推移-->
        <div style="width: 48%;">
            <h4>Number of Projects</h4>
            <canvas id="projectsChart"></canvas>
        </div>

        <!-- 3段目：プロジェクトのrequired rankの内訳-->
        <div class="d-flex justify-content-between mt-5">
            <div class="grid grid-cols-2 gap-4">
                <h4>Project Required Rank</h4>
                <canvas id="projectRanksChart" width="400" height="300"></canvas>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <h4>Freelancer's Rank</h4>
                <canvas id="freelancerRanksChart" width="400" height="300"></canvas>
            </div>
        </div>

        <!-- 4段目：スキル件数Top10グラフを横並びで追加 -->
        <div class="d-flex justify-content-between mt-5">
            <div style="width: 48%;">
                <h4>Project Required Skills Top 10 (Current)</h4>
                <canvas id="projectSkillTop10Chart"></canvas>
            </div>
            <div style="width: 48%;">
                <h4>Freelancer's Skills Top 10 (Current)</h4>
                <canvas id="freelancerSkillTop10Chart"></canvas>
            </div>
        </div>

        <!-- 5段目：スキルのグラフを横並びで追加 -->
        <div class="d-flex justify-content-between mt-5">
            <div style="width: 48%;">
                <h4>Project Required Skills Trends</h4>
                <canvas id="projectSkillsChart"></canvas>
            </div>
            <div style="width: 48%;">
                <h4>Freelancer's Skills Trends</h4>
                <canvas id="freelancerSkillsChart"></canvas>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
    const skillColorMap = {};

    function getSkillColor(skillName) {
        if (skillColorMap[skillName]) {
            return skillColorMap[skillName];
        }
        // なければ新規でランダムカラーを生成して保存
        const color = getRandomColor();
        skillColorMap[skillName] = color;
        return color;
    }

    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    
    document.addEventListener("DOMContentLoaded", function () {

        // "2025-02-10 ~ 2025-02-16" を "2/10 ~ 2/16" に変換
        function formatWeekRangeLabels(weeks) {
            return weeks.map(weekRange => {
                const dates = weekRange.split(' ~ ');

                const formatDate = (dateStr) => {
                    const [month, day] = dateStr.slice(5).split('-');
                    return `${parseInt(month)}/${parseInt(day)}`; // parseIntで先頭ゼロを除去
                };

                const startDate = formatDate(dates[0]);
                const endDate = formatDate(dates[1]);
                return `${startDate} ~ ${endDate}`;
            });
        }

        

        function getLegendOptions() {
            return {
                position: 'left',
                labels: {
                    usePointStyle: false,
                    boxWidth: 8,   // ← ここで凡例アイコンの横幅
                    boxHeight: 8,
                    generateLabels: function(chart) {
                        const data = chart.data;
                        if (data.datasets.length) {
                            return data.datasets.map((dataset, i) => {
                                return {
                                    text: dataset.label,
                                    fillStyle: dataset.borderColor || dataset.backgroundColor,
                                    strokeStyle: dataset.borderColor || dataset.backgroundColor,
                                    lineWidth: 1,
                                    hidden: !chart.isDatasetVisible(i),
                                    index: i
                                };
                            });
                        }
                        return [];
                    }
                }
            };
        }

        // 登録者数・プロジェクト数のデータ取得
        $.ajax({
            url: "{{ route('admin.statistics.data') }}",
            method: "GET",
            success: function (response) {
                console.log(response.weeks); 
                if (!response || !response.weeks) {
                    console.error("データが正しく取得できませんでした:", response);
                    return;
                }

                const ctxRegistrations = document.getElementById('registrationsChart').getContext('2d');
                const ctxProjects = document.getElementById('projectsChart').getContext('2d');
                const formattedLabels = formatWeekRangeLabels(response.weeks);
                
                // 登録者数のグラフ
                new Chart(ctxRegistrations, {
                    type: 'line',
                    data: {
                        labels: formattedLabels, // ← ここを差し替え,
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
                        labels: formattedLabels,
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

        // プロジェクトrequired rank 横棒グラフ
        $.ajax({
            url: "{{ route('admin.statistics.project_ranks') }}",
            method: "GET",
            success: function (response) {
                const ranks = [1, 2, 3, 4, 5];
                const data = response.counts;

                const ctx = document.getElementById('projectRanksChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ranks.map(r => `★`.repeat(r)),
                        datasets: [{
                            data: data,
                            backgroundColor: '#555555',  // 濃いグレー統一
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                                labels: {
                                    generateLabels: (chart) => [{
                                        text: '★ Project Rank',
                                        fillStyle: '#FFD700', // 星マークを黄色
                                        strokeStyle: '#000',
                                        hidden: false,
                                        index: 0
                                    }]
                                }
                            },
                            datalabels: { display: false } // 数値非表示
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1 // 横軸を1刻み
                                }
                            },
                            y: {
                                ticks: {
                                    color: '#FFD700', // 星マークを黄色に
                                    font: { weight: 'bold', size: 16 }
                                }
                            }
                        }
                    }
                });
            },
            error: function (error) { console.error("プロジェクトrank取得エラー:", error); }
        });

    // フリーランサーrank 横棒グラフ
        $.ajax({
            url: "{{ route('admin.statistics.freelancer_ranks') }}",
            method: "GET",
            success: function (response) {
                const ranks = [1, 2, 3, 4, 5];
                const data = response.counts;

                new Chart(document.getElementById('freelancerRanksChart').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: ranks.map(r => `★`.repeat(r)),
                        datasets: [{
                            data: data,
                            backgroundColor: '#555555', // 濃いグレー統一
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                                labels: {
                                    generateLabels: (chart) => [{
                                        text: '★ Freelancer Rank',
                                        fillStyle: '#FFD700', // 黄色の星マーク
                                        strokeStyle: '#000',
                                        hidden: false,
                                        index: 0
                                    }]
                                }
                            },
                            datalabels: { display: false } // 数値非表示
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1 // 横軸1刻み
                                }
                            },
                            y: {
                                ticks: {
                                    color: '#FFD700', // y軸ラベルを黄色
                                    font: { weight: 'bold', size: 16 }
                                }
                            }
                        }
                    }
                });
            },
            error: function (error) { console.error("フリーランサーrank取得エラー:", error); }
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

                const formattedWeeks = formatWeekRangeLabels(response.weeks);
                const datasets = response.skills.map(skill => ({
                    label: skill.name,
                    data: skill.weekly_counts,
                    borderColor: getSkillColor(skill.name),
                    backgroundColor: getSkillColor(skill.name) + '33', // 透過背景(任意)
                    fill: false
                }));

                new Chart(document.getElementById('projectSkillsChart').getContext('2d'), {
                    type: 'line',
                    data: { labels: formattedWeeks, datasets },
                    options: {
                        responsive: true,
                        scales: { y: { beginAtZero: true } },
                        plugins: {
                            legend: getLegendOptions()
                        }
                    }
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

                const formattedWeeks = formatWeekRangeLabels(response.weeks);
                const datasets = response.skills.map(skill => ({
                    label: skill.name,
                    data: skill.weekly_counts,
                    borderColor: getSkillColor(skill.name),
                    backgroundColor: getSkillColor(skill.name) + '33', // 透過背景(任意)
                    fill: false
                }));

                new Chart(document.getElementById('freelancerSkillsChart').getContext('2d'), {
                    type: 'line',
                    data: { labels: formattedWeeks, datasets },
                    options: {
                        responsive: true,
                        scales: { y: { beginAtZero: true } },
                        plugins: {
                            legend: getLegendOptions()
                        }
                    }
                });
            },
            error: function (error) { console.error("フリーランサースキルデータ取得エラー:", error); }
        });
    });

    $.ajax({
    url: "{{ route('admin.statistics.project_skill_top10') }}",
    method: "GET",
    success: function (response) {
        if (!response || response.length === 0) {
            console.error("プロジェクトスキルTop10データなし", response);
            return;
        }

        const skillNames = response.map(item => item.name);
        const skillCounts = response.map(item => item.count);

        new Chart(document.getElementById('projectSkillTop10Chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: skillNames,
                datasets: [{
                    label: 'Project Skill Count',
                    data: skillCounts,
                    backgroundColor: skillNames.map(name => getSkillColor(name)) 
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: { x: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });
    },
    error: function (error) { console.error("プロジェクトスキルTop10取得エラー", error); }
});

// フリーランサースキルTop10 グラフ
    $.ajax({
    url: "{{ route('admin.statistics.freelancer_skill_top10') }}",
    method: "GET",
    success: function (response) {
        console.log("フリーランサースキル取得データ",response);
        if (!response || response.length === 0) {
            console.error("フリーランサースキルTop10データなし", response);
            return;
        }

        const skillNames = response.map(item => item.name);
        const skillCounts = response.map(item => item.count);

        new Chart(document.getElementById('freelancerSkillTop10Chart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: skillNames,
                datasets: [{
                    label: 'Freelancer Skill Count',
                    data: skillCounts,
                    backgroundColor: skillNames.map(name => getSkillColor(name))
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                scales: { x: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });
    },
    error: function (error) { console.error("フリーランサースキルTop10取得エラー", error); }
});

</script>
@endsection