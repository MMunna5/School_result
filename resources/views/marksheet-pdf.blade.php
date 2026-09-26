<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
@page { size:595.28pt 841.89pt; margin:0; }
html,body{margin:0;padding:0;width:595.28pt;height:841.89pt;background:#fff}
body{font-family:DejaVu Sans,sans-serif;color:#111827;font-size:11pt}
*{box-sizing:border-box}
.page{position:relative;width:595.28pt;height:841.89pt;background:#fff;overflow:hidden}
.border1{position:absolute;left:24pt;top:24pt;width:547.28pt;height:793.89pt;border:2pt solid #1e3a8a}
.border2{position:absolute;left:29pt;top:29pt;width:537.28pt;height:783.89pt;border:.6pt solid #1e3a8a}
.logo{position:absolute;left:267.64pt;top:46pt;width:60pt;height:60pt;object-fit:contain}
.school{position:absolute;left:40pt;top:112pt;width:515.28pt;height:26pt;text-align:center;color:#1e3a8a;font-size:20pt;line-height:26pt;font-weight:bold}
.address{position:absolute;left:40pt;top:138pt;width:515.28pt;height:15pt;text-align:center;color:#4b5563;font-size:11pt;line-height:15pt}
.eiin{position:absolute;left:40pt;top:153pt;width:515.28pt;height:15pt;text-align:center;color:#4b5563;font-size:11pt;line-height:15pt}
.rule{position:absolute;left:40pt;top:174pt;width:515.28pt;border-top:.8pt solid #9ca3af}
.title{position:absolute;left:40pt;top:182pt;width:515.28pt;height:21pt;text-align:center;font-size:15pt;line-height:21pt;font-weight:bold;color:#111827}
.exam{position:absolute;left:40pt;top:203pt;width:515.28pt;height:20pt;text-align:center;font-size:11.5pt;line-height:20pt;color:#111827}
.info{position:absolute;left:40pt;top:227pt;width:515.28pt;border-collapse:collapse;table-layout:fixed}
.info td{height:19pt;padding:0;font-size:11pt;line-height:19pt;white-space:nowrap;vertical-align:top}
.info .label{width:84pt;color:#4b5563;font-weight:bold}
.info .value{padding-left:4pt;width:173.64pt;color:#111827}
.marks{position:absolute;left:40pt;top:297pt;width:515.28pt;border-collapse:collapse;table-layout:fixed}
.marks th,.marks td{height:21pt;padding:0 6pt;border:.5pt solid #9ca3af;font-size:10.5pt;line-height:21pt;vertical-align:middle}
.marks th{background:#e5e7eb;font-weight:bold}
.subject{width:200pt;text-align:left}.code{width:60pt;text-align:center}.full{width:70pt;text-align:center}.obtained{width:60pt;text-align:center}.grade{width:55pt;text-align:center}.point{width:70pt;text-align:center}
.summary{position:absolute;left:40pt;top:455pt;width:515.28pt;border-collapse:separate;border-spacing:10pt 0;table-layout:fixed}
.summary td{height:46pt;border:.8pt solid #9ca3af;border-radius:4pt;padding:0;text-align:center;vertical-align:middle}
.small{color:#4b5563;font-size:9.5pt;line-height:12pt}.big{font-size:15pt;line-height:17pt;font-weight:bold;white-space:nowrap}
.qr{position:absolute;left:44pt;top:651.89pt;width:96pt;height:96pt}
.qrnote{position:absolute;left:40pt;top:751.89pt;width:108pt;text-align:center;color:#4b5563;font-size:8.5pt;line-height:11pt}
.signature{position:absolute;left:385.28pt;top:651.89pt;width:130pt;height:60pt;object-fit:contain}
.signline{position:absolute;left:385.28pt;top:719.89pt;width:170pt;border-top:.8pt solid #111827;padding-top:4pt;text-align:center;font-size:11pt;line-height:13pt;font-weight:bold}
.note{position:absolute;left:40pt;top:789.89pt;width:515.28pt;text-align:center;color:#4b5563;font-size:8pt;line-height:10pt;margin:0}
</style>
</head>
<body>
@php
$logo=public_path('6716-removebg-preview.png');
$signature=public_path('head-signature.png');
$qrUrl='https://quickchart.io/qr?size=300&margin=1&text='.urlencode($data['verify_url']??'');
$student=$data['student']; $school=$data['school']; $summary=$data['summary'];
@endphp
<div class="page">
<div class="border1"></div><div class="border2"></div>
@if(is_file($logo))<img class="logo" src="data:image/png;base64,{{base64_encode(file_get_contents($logo))}}">@endif
<div class="school">{{ $school['name'] ?? 'School Result' }}</div>
<div class="address">{{ $school['address'] ?? '' }}</div>
@if(!empty($school['eiin']))<div class="eiin">EIIN: {{ $school['eiin'] }}</div>@endif
<div class="rule"></div>
<div class="title">ACADEMIC MARKSHEET</div>
<div class="exam">{{ $student->exam_name ?? '' }} - {{ $student->exam_year ?? '' }}</div>
<table class="info">
<tr><td class="label">Student Name:</td><td class="value">{{ $student->name }}</td><td class="label">Roll:</td><td class="value">{{ $student->roll }}</td></tr>
<tr><td class="label">Registration:</td><td class="value">{{ $student->registration ?: '-' }}</td><td class="label">Class:</td><td class="value">{{ $student->class_name }}</td></tr>
<tr><td class="label">Group:</td><td class="value">{{ $student->group_name ?: '-' }}</td><td class="label">Year:</td><td class="value">{{ $student->exam_year }}</td></tr>
</table>
<table class="marks">
<thead><tr><th class="subject">Subject</th><th class="code">Code</th><th class="full">Full Marks</th><th class="obtained">Marks</th><th class="grade">Grade</th><th class="point">Grade Point</th></tr></thead>
<tbody>@foreach($data['subjects'] as $s)<tr><td class="subject">{{ $s->subject_name }}</td><td class="code">{{ $s->subject_code }}</td><td class="full">{{ $s->full_marks }}</td><td class="obtained">{{ $s->marks }}</td><td class="grade">{{ $s->grade }}</td><td class="point">{{ number_format((float)$s->grade_point,2) }}</td></tr>@endforeach</tbody>
</table>
<table class="summary"><tr>
<td><div class="small">Total Marks</div><div class="big">{{ $summary['total_marks'] }} / {{ $summary['total_full_marks'] }}</div></td>
<td><div class="small">GPA</div><div class="big">{{ number_format((float)$summary['gpa'],2) }}</div></td>
<td><div class="small">Result</div><div class="big">{{ $summary['result'] }}</div></td>
<td><div class="small">Position</div><div class="big">{{ $summary['position'] ?? '-' }}</div></td>
</tr></table>
@if(!empty($data['verify_url']))<img class="qr" src="{{ $qrUrl }}" alt=""><div class="qrnote">Scan to verify this result</div>@endif
@if(is_file($signature))<img class="signature" src="data:image/png;base64,{{base64_encode(file_get_contents($signature))}}" alt="">@endif
<div class="signline">Head Teacher</div>
<p class="note">This is a computer generated marksheet. Its authenticity can be checked by scanning the QR code.</p>
</div>
</body>
</html>