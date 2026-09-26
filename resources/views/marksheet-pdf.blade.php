<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
@page { size:A4 portrait; margin:0; }
*{box-sizing:border-box}
body{margin:0;background:#e2e8f0;font-family:DejaVu Sans, sans-serif;font-size:11px;color:#0f172a}
.sheet{width:193mm;height:280mm;margin:8.5mm auto;padding:14mm;background:#fff;border:4px double #1e3a8a;overflow:hidden}
.header{text-align:center}
.logo{width:64px;height:64px;object-fit:contain;margin:0 auto 3px}
.school{margin:0;font-size:20px;font-weight:700;color:#1e3a8a}
.muted{margin:2px 0;color:#64748b;font-size:10px}
.title{margin:14px 0 8px;padding-top:8px;border-top:1px solid #cbd5e1;text-align:center}
.title h2{margin:0;font-size:14px;letter-spacing:1px}
.info{width:100%;border-collapse:collapse;margin-top:8px}
.info td{border:0;padding:3px 2px;font-size:10.5px}
.info .label{font-weight:700;color:#64748b;width:17%}
.marks{width:100%;border-collapse:collapse;margin-top:14px}
.marks th,.marks td{border:1px solid #94a3b8;padding:6px 5px}
.marks th{background:#f1f5f9;font-weight:700}
.center{text-align:center}
.summary{width:100%;border-collapse:separate;border-spacing:5px;margin-top:12px}
.summary td{border:1px solid #cbd5e1;border-radius:6px;padding:7px;text-align:center;width:25%}
.summary .small{font-size:9px;color:#64748b}
.summary .big{font-size:14px;font-weight:700;margin-top:3px}
.footer{margin-top:35px;width:100%;display:table}
.footer-left,.footer-right{display:table-cell;vertical-align:bottom;width:50%;text-align:center}
.qr{width:86px;height:86px}
.signature{width:180px;height:52px;object-fit:contain}
.signline{border-top:1px solid #0f172a;margin:3px auto 0;width:180px;padding-top:3px;font-weight:700}
.note{text-align:center;margin-top:15px;color:#94a3b8;font-size:8.5px}
</style>
</head>
<body>
<div class="sheet">
<header class="header">
@php
$logo = public_path('6716-removebg-preview.png');
$signature = public_path('head-signature.png');
$qrUrl = 'https://quickchart.io/qr?size=220&margin=1&text='.urlencode($data['verify_url'] ?? '');
@endphp
@if(is_file($logo))
<img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents($logo)) }}" alt="">
@endif
<h1 class="school">{{ $data['school']['name'] ?? 'School Result' }}</h1>
@if(!empty($data['school']['address']))<p class="muted">{{ $data['school']['address'] }}</p>@endif
@if(!empty($data['school']['eiin']))<p class="muted">EIIN: {{ $data['school']['eiin'] }}</p>@endif
</header>

<div class="title">
<h2>ACADEMIC MARKSHEET</h2>
<p class="muted">{{ $data['student']->exam_name ?? '' }} - {{ $data['student']->exam_year ?? '' }}</p>
</div>

<table class="info">
<tr><td class="label">Student Name:</td><td>{{ $data['student']->name }}</td><td class="label">Roll:</td><td>{{ $data['student']->roll }}</td></tr>
<tr><td class="label">Registration:</td><td>{{ $data['student']->registration ?: '-' }}</td><td class="label">Class:</td><td>{{ $data['student']->class_name }}</td></tr>
<tr><td class="label">Group:</td><td>{{ $data['student']->group_name ?: '-' }}</td><td class="label">Year:</td><td>{{ $data['student']->exam_year }}</td></tr>
</table>

<table class="marks">
<thead><tr><th>Subject</th><th class="center">Code</th><th class="center">Full Marks</th><th class="center">Marks</th><th class="center">Grade</th><th class="center">Grade Point</th></tr></thead>
<tbody>
@foreach($data['subjects'] as $s)
<tr>
<td>{{ $s->subject_name }}</td>
<td class="center">{{ $s->subject_code }}</td>
<td class="center">{{ $s->full_marks }}</td>
<td class="center">{{ $s->marks }}</td>
<td class="center">{{ $s->grade }}</td>
<td class="center">{{ number_format((float)$s->grade_point,2) }}</td>
</tr>
@endforeach
</tbody>
</table>

<table class="summary">
<tr>
<td><div class="small">Total Marks</div><div class="big">{{ $data['summary']['total_marks'] }} / {{ $data['summary']['total_full_marks'] }}</div></td>
<td><div class="small">GPA</div><div class="big">{{ number_format((float)$data['summary']['gpa'],2) }}</div></td>
<td><div class="small">Result</div><div class="big">{{ $data['summary']['result'] }}</div></td>
<td><div class="small">Position</div><div class="big">{{ $data['summary']['position'] }}</div></td>
</tr>
</table>

<footer class="footer">
<div class="footer-left">
<img class="qr" src="{{ $qrUrl }}" alt="QR code">
<p class="muted">Scan to verify this result</p>
</div>
<div class="footer-right">
@if(is_file($signature))
<img class="signature" src="data:image/png;base64,{{ base64_encode(file_get_contents($signature)) }}" alt="">
@endif
<div class="signline">Head Teacher</div>
</div>
</footer>
<p class="note">This is a computer generated marksheet. Its authenticity can be checked by scanning the QR code.</p>
</div>
</body>
</html>