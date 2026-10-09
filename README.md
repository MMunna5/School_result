Design-only update, round 2 — 5 files changed, no PHP/backend logic touched:

1) public/css/app.css
   - Round 1: Inter font, refined shadows/radius, gradient buttons,
     dotted badges, sticky table header + row hover, sidebar gold
     active-indicator, breadcrumb/back bar styling.
   - Round 2 (new): decorative "mesh" blob background, split-panel
     login styling (.brand-panel), topbar avatar-chip styling,
     a colored top accent on the dashboard stat cards.

2) public/js/app.js
   - Round 1: breadcrumb + "Back" bar on every admin/teacher page
     (built once in App.shell, appears everywhere automatically).
   - Round 2 (new): topbar now shows a small circular avatar (first
     letter of the username) next to the name + role badge, instead
     of plain text.

3) resources/views/marksheet.blade.php
   - Restyled only the on-screen toolbar above the certificate.
     The printable sheet (#sheet) and its print-scaling script are
     untouched, so PDF/print output is unaffected.

4) resources/views/pages/admin-login.blade.php  (new this round)
   - Rebuilt as a two-panel layout: a branded navy/gold panel on the
     left (desktop) + the sign-in form on the right, like a modern
     SaaS admin login. All input ids and the login script are
     unchanged — only markup/classes were restructured.

5) resources/views/index.blade.php  (new this round)
   - Added the same soft decorative background blobs behind the
     public landing page hero. Content/text unchanged.

How to apply: copy these files into your project at the same paths,
overwriting the existing ones. No composer/npm step needed — the
site still runs on the plain compiled app.css/app.js, no build tool
required.
