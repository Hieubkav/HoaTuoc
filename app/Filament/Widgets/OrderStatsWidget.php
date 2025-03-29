<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Filament\Pages\Dashboard;

class OrderStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Thống kê đơn hàng';

    protected static ?int $sort = 1;

    protected static string $pageClass = Dashboard::class;

    protected function getType(): string
    {
        return 'bar'; // Sử dụng bar chart làm base
    }

    // Tab đang được chọn
    public ?string $filter = 'today';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hôm nay',
            'week' => 'Tuần này',
            'month' => 'Tháng này',
            'year' => 'Năm nay',
            'last_year' => 'Năm ngoái',
            'all' => 'Tất cả',
        ];
    }

    protected function getData(): array
    {
        $query = Order::query()
            ->where('status', 'completed');

        // Lọc theo thời gian
        $query = match ($this->filter) {
            'today' => $query->whereDate('created_at', Carbon::today()),
            'week' => $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]),
            'month' => $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year),
            'year' => $query->whereYear('created_at', Carbon::now()->year),
            'last_year' => $query->whereYear('created_at', Carbon::now()->subYear()->year),
            default => $query
        };

        $orders = $query->get();

        // Tổng số tiền và số lượng đơn
        $totalAmount = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        $totalItems = $orders->sum('total_items');

        return [
            'datasets' => [
                [
                    'label' => 'Tổng tiền (VNĐ)',
                    'data' => [$totalAmount],
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#9BD0F5',
                    'type' => 'bar',
                    'yAxisID' => 'y',
                ],
                [
                    'label' => 'Số lượng món',
                    'data' => [$totalItems],
                    'borderColor' => '#FF6384',
                    'backgroundColor' => '#FFB1C1',
                    'type' => 'line',
                    'yAxisID' => 'y1',
                ]
            ],
            'labels' => [$this->filter === 'today' ? 'Hôm nay' : 
                        ($this->filter === 'week' ? 'Tuần này' :
                        ($this->filter === 'month' ? 'Tháng này' :
                        ($this->filter === 'year' ? 'Năm nay' :
                        ($this->filter === 'last_year' ? 'Năm ngoái' : 'Tất cả'))))],
        ];
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => 'Tổng tiền (VNĐ)'
                    ],
                ],
                'y1' => [
                    'type' => 'linear',
                    'display' => true,
                    'position' => 'right',
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Số lượng món'
                    ],
                ],
            ],
            'interaction' => [
                'intersect' => false,
                'mode' => 'index',
            ],
        ];
    }
}