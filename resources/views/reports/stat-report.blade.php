<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير {{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            padding: 30px;
            background: #f5f5f5;
        }
        .header {
            background: linear-gradient(135deg, #003366, #0055AA);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
        }
        .stat-card .label {
            font-size: 12px;
            color: #666;
            margin-bottom: 8px;
        }
        .stat-card .value {
            font-size: 24px;
            font-weight: bold;
            color: #003366;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: right;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background: #f5f5f5;
            font-weight: bold;
            color: #003366;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>تقرير: {{ $title }}</h1>
        <p>تاريخ الإصدار: {{ now()->format('Y-m-d H:i') }}</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="label">القيمة الحالية</div>
            <div class="value">{{ $value }}</div>
        </div>
        <div class="stat-card">
            <div class="label">المعدل الأسبوعي</div>
            <div class="value">{{ $weeklyAvg }}</div>
        </div>
        <div class="stat-card">
            <div class="label">أعلى قيمة</div>
            <div class="value">{{ $peak }}</div>
        </div>
        <div class="stat-card">
            <div class="label">التغيير</div>
            <div class="value">{{ $trend }}</div>
        </div>
    </div>

    <div class="table-container">
        <h3 style="margin-bottom: 15px; color: #003366;">التفاصيل اليومية</h3>
        <table>
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>القيمة</th>
                    <th>التغيير</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tableData as $row)
                <tr>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['value'] }}</td>
                    <td>{{ $row['change'] >= 0 ? '+' : '' }}{{ $row['change'] }}%</td>
                    <td>{{ $row['status'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>© {{ now()->year }} Absher Intelligence - جميع الحقوق محفوظة</p>
    </div>
</body>
</html>
