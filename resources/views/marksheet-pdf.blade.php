<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
@page{size:A4 portrait;margin:0}
html,body{width:210mm;height:297mm;margin:0;padding:0;background:#fff}
body{font-family:DejaVu Sans,sans-serif;color:#111827}
*{box-sizing:border-box}
.sheet{
    width:193mm;
    height:280mm;
    margin:8.5mm auto;
    padding:14mm;
    background:#fff;
    border:4px double #1e3a8a;
    position:relative;
    overflow:hidden;
}
.header{text-align:center}
.logo{display:block;width:64px;height:64px;object-fit:contain;margin:0 auto}
.school{margin-top:4px;font-size:24px;line-height:29px;font-weight:700;color:#1e3a8a}
.address,.eiin{font-size:14px;line-height:19px;color:#64748b}
.exam-block{margin:16px 0 0;padding-top:12px;border-top:1px solid #cbd5e1;text-align:center}
.title{font-size:18px;line-height:24px;font-weight:700;letter-spacing:.5px}
.exam{font-size:14px;line-height:20px;color:#475569}
.info{width:100%;margin-top:6px;border-collapse:separate;border-spacing:24px 3px;table-layout:fixed;font-size:14px}
.info td{padding:0;height:20px;line-height:20px;vertical-align:top;white-space:nowrap}
.info .label{width:23%;font-weight:700;color:#64748b}
.info .value{width:27%;color:#111827;overflow:hidden}
.marks-wrap{margin-top:20px;border:1px solid #94a3b8;border-radius:4px;overflow:hidden}
.marks{width:100%;border-collapse:collapse;table-layout:fixed;font-size:13px}
.marks th,.marks td{padding:7px 9px;line-height:16px;border-bottom:1px solid #cbd5e1;border-right:1px solid #cbd5e1;height:30px;vertical-align:middle}
.marks th:last-child,.marks td:last-child{border-right:0}
.marks th{background:#f1f5f9;font-weight:700;text-align:left}
.marks .subject{width:38.8%;text-align:left}
.marks .code{width:11.7%;text-align:center}
.marks .full{width:13.6%;text-align:center}
.marks .obtained{width:11.7%;text-align:center}
.marks .grade{width:10.7%;text-align:center}
.marks .point{width:13.6%;text-align:center}
.summary{width:100%;margin-top:20px;border-collapse:separate;border-spacing:0 0;table-layout:fixed}
.summary td{height:58px;border:1px solid #cbd5e1;border-radius:8px;padding:7px;text-align:center;vertical-align:middle}
.summary td+td{border-left:0}
.small{font-size:11px;line-height:14px;color:#64748b}
.big{font-size:18px;line-height:21px;font-weight:700;white-space:nowrap}
.footer{
    position:absolute;
    left:14mm;
    right:14mm;
    bottom:17mm;
    display:table;
    width:calc(100% - 28mm);
}
.footer-left,.footer-right{display:table-cell;vertical-align:bottom}
.footer-left{width:50%;text-align:center}
.footer-right{width:50%;text-align:center}
.qr{width:96px;height:96px;object-fit:contain;margin:0 auto}
.qrnote{margin-top:4px;font-size:11px;line-height:14px;color:#64748b}
.signature{width:192px;height:56px;object-fit:contain;margin:0 auto}
.signline{width:192px;border-top:1px solid #111827;padding-top:4px;margin:0 auto;font-size:14px;line-height:17px;font-weight:700}
.note{
    position:absolute;
    left:14mm;
    right:14mm;
    bottom:7mm;
    margin:0;
    text-align:center;
    font-size:11px;
    line-height:14px;
    color:#94a3b8;
}
</style>
</head>
<body>
@php
$logo=public_path('6716-removebg-preview.png');
$signature=public_path('head-signature.png');
$qrData=$data['qr_data']??null;
$student=$data['student'];
$school=$data['school'];
$summary=$data['summary'];
@endphp
<article class="sheet">
    <header class="header">
        @if(is_file($logo))
            <img class="logo" src="data:image/png;base64,{{base64_encode(file_get_contents($logo))}}" alt="">
        @endif
        <div class="school">{{ $school['name'] ?? 'School Result' }}</div>
        <div class="address">{{ $school['address'] ?? '' }}</div>
        @if(!empty($school['eiin']))
            <div class="eiin">EIIN: {{ $school['eiin'] }}</div>
        @endif
    </header>

    <div class="exam-block">
        <div class="title">ACADEMIC MARKSHEET</div>
        <div class="exam">{{ $student->exam_name ?? '' }} - {{ $student->exam_year ?? '' }}</div>
    </div>

    <table class="info">
        <tr>
            <td class="label">Student Name:</td><td class="value">{{ $student->name }}</td>
            <td class="label">Roll:</td><td class="value">{{ $student->roll }}</td>
        </tr>
        <tr>
            <td class="label">Registration:</td><td class="value">{{ $student->registration ?: '-' }}</td>
            <td class="label">Class:</td><td class="value">{{ $student->class_name }}</td>
        </tr>
        <tr>
            <td class="label">Group:</td><td class="value">{{ $student->group_name ?: '-' }}</td>
            <td class="label">Year:</td><td class="value">{{ $student->exam_year }}</td>
        </tr>
    </table>

    <div class="marks-wrap">
        <table class="marks">
            <thead>
                <tr>
                    <th class="subject">Subject</th>
                    <th class="code">Code</th>
                    <th class="full">Full Marks</th>
                    <th class="obtained">Marks</th>
                    <th class="grade">Grade</th>
                    <th class="point">Grade Point</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data['subjects'] as $s)
                <tr>
                    <td class="subject">{{ $s->subject_name }}</td>
                    <td class="code">{{ $s->subject_code }}</td>
                    <td class="full">{{ $s->full_marks }}</td>
                    <td class="obtained">{{ $s->marks }}</td>
                    <td class="grade">{{ $s->grade }}</td>
                    <td class="point">{{ number_format((float)$s->grade_point,2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <table class="summary">
        <tr>
            <td><div class="small">Total Marks</div><div class="big">{{ $summary['total_marks'] }} / {{ $summary['total_full_marks'] }}</div></td>
            <td><div class="small">GPA</div><div class="big">{{ number_format((float)$summary['gpa'],2) }}</div></td>
            <td><div class="small">Result</div><div class="big">{{ $summary['result'] }}</div></td>
            <td><div class="small">Position</div><div class="big">{{ $summary['position'] ?? '-' }}</div></td>
        </tr>
    </table>

    <footer class="footer">
        <div class="footer-left">
            @if(!empty($qrData))
                <img class="qr" src="{{ $qrData }}" alt="">
            @endif
            <div class="qrnote">Scan to verify this result</div>
        </div>
        <div class="footer-right">
            @if(is_file($signature))
                <img class="signature" src="data:image/png;base64,{{base64_encode(file_get_contents($signature))}}" alt="">
            @endif
            <div class="signline">Head Teacher</div>
        </div>
    </footer>

    <p class="note">This is a computer generated marksheet. Its authenticity can be checked by scanning the QR code.</p>
</article>
</body>
</html>