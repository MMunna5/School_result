<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
@page { size: A4 portrait; margin: 0; }

* { box-sizing: border-box; }

html, body {
    width: 210mm;
    height: 297mm;
    margin: 0;
    padding: 0;
    background: #fff;
    font-family: DejaVu Sans, sans-serif;
    color: #111827;
    font-size: 11px;
}

body {
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
}

.sheet {
    position: relative;
    width: 193mm;
    height: 280mm;
    margin: 8.5mm auto;
    padding: 14mm;
    overflow: hidden;
    background: #fff;
    border: 4px double #1e3a8a;
}

/* Same proportions as the original PDFKit marksheet */
.header {
    width: 100%;
    text-align: center;
}

.logo {
    display: block;
    width: 60px;
    height: 60px;
    object-fit: contain;
    margin: 0 auto;
}

.school {
    margin: 6px 0 0;
    color: #1e3a8a;
    font-size: 20px;
    line-height: 26px;
    font-weight: 700;
    text-align: center;
}

.muted {
    margin: 2px 0 0;
    color: #4b5563;
    font-size: 11px;
    line-height: 15px;
    text-align: center;
}

.title {
    margin-top: 14px;
    padding-top: 8px;
    border-top: 1px solid #9ca3af;
    text-align: center;
}

.title h2 {
    margin: 0;
    font-size: 15px;
    line-height: 21px;
    letter-spacing: .2px;
    font-weight: 700;
}

.title p {
    margin-top: 4px;
}

.info {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
    table-layout: fixed;
}

.info td {
    border: 0;
    padding: 3px 0;
    height: 19px;
    font-size: 11px;
    line-height: 13px;
    vertical-align: middle;
}

.info .label {
    width: 84px;
    color: #4b5563;
    font-weight: 700;
    white-space: nowrap;
}

.info .value {
    width: auto;
    padding-left: 4px;
    padding-right: 8px;
    white-space: nowrap;
}

.marks {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    margin-top: 14px;
}

.marks th,
.marks td {
    border: 1px solid #9ca3af;
    padding: 5px 6px;
    height: 21px;
    line-height: 11px;
    font-size: 10.5px;
    vertical-align: middle;
}

.marks th {
    background: #e5e7eb;
    font-weight: 700;
}

.marks .subject {
    width: 34%;
    text-align: left;
}

.marks .code {
    width: 10%;
    text-align: center;
}

.marks .full {
    width: 12%;
    text-align: center;
}

.marks .obtained {
    width: 10%;
    text-align: center;
}

.marks .grade {
    width: 12%;
    text-align: center;
}

.marks .point {
    width: 22%;
    text-align: center;
}

.center { text-align: center; }

.summary {
    width: 100%;
    border-collapse: separate;
    border-spacing: 10px 0;
    margin-top: 16px;
    margin-left: -10px;
    width: calc(100% + 20px);
    table-layout: fixed;
}

.summary td {
    height: 46px;
    border: 1px solid #9ca3af;
    border-radius: 4px;
    padding: 7px 5px;
    text-align: center;
    vertical-align: middle;
}

.summary .small {
    color: #4b5563;
    font-size: 9.5px;
    line-height: 12px;
}

.summary .big {
    margin-top: 3px;
    font-size: 15px;
    line-height: 17px;
    font-weight: 700;
    white-space: nowrap;
}

.footer {
    position: absolute;
    left: 14mm;
    right: 14mm;
    bottom: 28mm;
    height: 108px;
}

.footer-left,
.footer-right {
    position: absolute;
    bottom: 0;
    width: 50%;
    text-align: center;
}

.footer-left { left: 0; }
.footer-right { right: 0; }

.qr {
    display: block;
    width: 96px;
    height: 96px;
    margin: 0 auto;
}

.qr-note {
    margin: 4px auto 0;
    color: #4b5563;
    font-size: 8.5px;
    line-height: 11px;
    text-align: center;
}

.signature {
    display: block;
    width: 130px;
    height: 60px;
    object-fit: contain;
    margin: 0 auto 8px;
}

.signline {
    width: 170px;
    margin: 0 auto;
    padding-top: 4px;
    border-top: 1px solid #111827;
    color: #111827;
    font-size: 11px;
    line-height: 13px;
    font-weight: 700;
    text-align: center;
}

.note {
    position: absolute;
    left: 14mm;
    right: 14mm;
    bottom: 12mm;
    margin: 0;
    color: #4b5563;
    font-size: 8px;
    line-height: 10px;
    text-align: center;
}
</style>
</head>
<body>
@php
    $logo = public_path('6716-removebg-preview.png');
    $signature = public_path('head-signature.png');
    $qrUrl = 'https://quickchart.io/qr?size=300&margin=1&text=' . urlencode($data['verify_url'] ?? '');
    $student = $data['student'];
    $school = $data['school'];
    $summary = $data['summary'];
@endphp

<div class="sheet">

    <header class="header">
        @if(is_file($logo))
            <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents($logo)) }}" alt="">
        @endif

        <div class="school">{{ $school['name'] ?? 'School Result' }}</div>

        @if(!empty($school['address']))
            <div class="muted">{{ $school['address'] }}</div>
        @endif

        @if(!empty($school['eiin']))
            <div class="muted">EIIN: {{ $school['eiin'] }}</div>
        @endif
    </header>

    <section class="title">
        <h2>ACADEMIC MARKSHEET</h2>
        <p class="muted">{{ $student->exam_name ?? '' }} - {{ $student->exam_year ?? '' }}</p>
    </section>

    <table class="info">
        <tr>
            <td class="label">Student Name:</td>
            <td class="value">{{ $student->name }}</td>
            <td class="label">Roll:</td>
            <td class="value">{{ $student->roll }}</td>
        </tr>
        <tr>
            <td class="label">Registration:</td>
            <td class="value">{{ $student->registration ?: '-' }}</td>
            <td class="label">Class:</td>
            <td class="value">{{ $student->class_name }}</td>
        </tr>
        <tr>
            <td class="label">Group:</td>
            <td class="value">{{ $student->group_name ?: '-' }}</td>
            <td class="label">Year:</td>
            <td class="value">{{ $student->exam_year }}</td>
        </tr>
    </table>

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
                <td class="point">{{ number_format((float)$s->grade_point, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="summary">
        <tr>
            <td>
                <div class="small">Total Marks</div>
                <div class="big">{{ $summary['total_marks'] }} / {{ $summary['total_full_marks'] }}</div>
            </td>
            <td>
                <div class="small">GPA</div>
                <div class="big">{{ number_format((float)$summary['gpa'], 2) }}</div>
            </td>
            <td>
                <div class="small">Result</div>
                <div class="big">{{ $summary['result'] }}</div>
            </td>
            <td>
                <div class="small">Position</div>
                <div class="big">{{ $summary['position'] ?? '-' }}</div>
            </td>
        </tr>
    </table>

    <footer class="footer">
        <div class="footer-left">
            <img class="qr" src="{{ $qrUrl }}" alt="QR code">
            <div class="qr-note">Scan to verify this result</div>
        </div>

        <div class="footer-right">
            @if(is_file($signature))
                <img class="signature" src="data:image/png;base64,{{ base64_encode(file_get_contents($signature)) }}" alt="">
            @endif
            <div class="signline">Head Teacher</div>
        </div>
    </footer>

    <p class="note">
        This is a computer generated marksheet. Its authenticity can be checked by scanning the QR code.
    </p>
</div>
</body>
</html>