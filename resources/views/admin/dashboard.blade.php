@extends('layouts.main')
@section('info')
@if (Auth::user()->role == 'admin')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Daftar Produk Film</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pembelian Tiket Per Bulan</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-md-3">
                        <h6 class="text-primary">Total Transaksi</h6>
                        <h4 id="totalTransaksi">-</h4>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-success">Total Pendapatan</h6>
                        <h4 id="totalPendapatan">-</h4>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-info">Rata-rata/Bulan</h6>
                        <h4 id="rataRata">-</h4>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-warning">Bulan Tertinggi</h6>
                        <h4 id="bulanTertinggi">-</h4>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">

            @foreach ($films as $f)
                <div class="col-md-4 mb-4">
                    <div class="card shadow" style="height: 100%;">
                        <img src="{{ asset('uploads/' . $f->poster) }}"
                            style="width: 100%; height: 300px; object-fit: cover;" class="card-img-top" alt="Poster Film">
                        <div class="card-body">
                            <h5 class="card-title">{{ $f->judul }}</h5>
                            <p class="card-text">
                                {{ Str::limit($f->sinopsis, 100) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Chart.js CDN -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataChart = @json($dataChart);
    console.log('Data Chart:', dataChart);


    const namaBulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];


    const chartLabels = namaBulan;
    const chartData = dataChart.map(item => item.total_harga);

    console.log('Chart Labels:', chartLabels);
    console.log('Chart Data:', chartData);

    const ctx = document.getElementById("myAreaChart").getContext('2d');
    const myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: "Total Pembelian (Rp)",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.1)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(255,255,255, 1)",
                pointHoverRadius: 6,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(255,255,255, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: chartData,
                fill: true
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                },
                y: {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    titleMarginBottom: 10,
                    titleColor: '#6e707e',
                    titleFont: {
                        size: 14
                    },
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    padding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    callbacks: {
                        title: function(context) {
                            return namaBulan[context[0].dataIndex];
                        },
                        label: function(context) {
                            return 'Total Pembelian: Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            responsive: true,
            interaction: {
                intersect: false,
                mode: 'index',
            }
        }
    });


    function updateStatistics() {
        const totalPendapatan = chartData.reduce((sum, value) => sum + value, 0);
        const totalBulanAktif = chartData.filter(value => value > 0).length;
        const rataRata = totalBulanAktif > 0 ? totalPendapatan / 12 : 0;

        const maxValue = Math.max(...chartData);
        const maxIndex = chartData.indexOf(maxValue);
        const bulanTertinggi = maxValue > 0 ? namaBulan[maxIndex] : 'Belum ada';


        document.getElementById('totalTransaksi').textContent = totalBulanAktif + ' bulan aktif';
        document.getElementById('totalPendapatan').textContent = 'Rp ' + totalPendapatan.toLocaleString('id-ID');
        document.getElementById('rataRata').textContent = 'Rp ' + Math.round(rataRata).toLocaleString('id-ID');
        document.getElementById('bulanTertinggi').textContent = bulanTertinggi;
    }


    updateStatistics();
</script>
@endsection
