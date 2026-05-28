<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PSU EduTrack — @yield('page-title','Dashboard')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

:root{
  /* PSU Blue & Gold palette */
  --psu-blue:      #03173c;
  --psu-blue-mid:  #004DB3;
  --psu-blue-light:#0062CC;
  --psu-blue-dim:  rgba(0,48,135,.08);
  --psu-blue-glow: rgba(0,77,179,.2);
  --psu-gold:      #F5A800;
  --psu-gold-deep: #D4900A;
  --psu-gold-dim:  rgba(245,168,0,.12);
  --psu-gold-glow: rgba(245,168,0,.3);

  --bg:      #F0F4FA;
  --surface: #FFFFFF;
  --card:    #FFFFFF;
  --border:  #DDE3EF;
  --border2: #C8D1E6;

  --text:    #0D1B3E;
  --muted:   #6272A4;
  --muted2:  #A0ADCC;

  --green:     #16A34A;
  --green-dim: rgba(22,163,74,.1);
  --red:       #DC2626;
  --red-dim:   rgba(220,38,38,.1);
  --amber:     #D97706;
  --amber-dim: rgba(217,119,6,.1);

  --radius:    14px;
  --radius-sm: 8px;
  --sw:        260px;
}

body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;font-size:14px}

/* ── Sidebar ─────────────────────────── */
.sidebar{
  width:var(--sw);min-height:100vh;
  background:var(--psu-blue);
  display:flex;flex-direction:column;
  position:fixed;top:0;left:0;z-index:60;
  box-shadow:4px 0 24px rgba(0,30,100,.18);
}

/* Gold top accent bar */
.sidebar::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  background:linear-gradient(90deg,var(--psu-gold),var(--psu-gold-deep),var(--psu-gold));
}

.sb-top{padding:28px 20px 20px;border-bottom:1px solid rgba(255,255,255,.1)}
.sb-brand{display:flex;align-items:center;gap:12px;text-decoration:none}

.sb-seal{
  width:46px;height:46px;border-radius:50%;
  background:rgba(255,255,255,.15);
  border:2px solid var(--psu-gold);
  display:flex;align-items:center;justify-content:center;
  font-size:22px;flex-shrink:0;
  box-shadow:0 0 12px var(--psu-gold-glow);
}

.sb-name-wrap{}
.sb-uni{font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--psu-gold);margin-bottom:1px}
.sb-app{font-family:'Playfair Display',serif;font-size:1.15rem;color:#fff;line-height:1.1}
.sb-tag{font-size:.6rem;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-top:2px}

.sb-nav{flex:1;padding:16px 12px;overflow-y:auto}

.sb-section{
  font-size:.62rem;font-weight:700;letter-spacing:.13em;text-transform:uppercase;
  color:rgba(255,255,255,.3);padding:0 10px;margin:20px 0 6px;
}
.sb-section:first-child{margin-top:0}

.sb-link{
  display:flex;align-items:center;gap:10px;
  padding:9px 10px;border-radius:var(--radius-sm);
  color:rgba(255,255,255,.6);text-decoration:none;
  font-size:.83rem;font-weight:500;
  transition:all .15s;margin-bottom:2px;position:relative;
}
.sb-link:hover{background:rgba(255,255,255,.1);color:#fff}
.sb-link.active{background:rgba(245,168,0,.18);color:var(--psu-gold)}
.sb-link.active::before{
  content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);
  width:3px;height:60%;background:var(--psu-gold);border-radius:999px;
}
.sb-link .si{width:20px;height:20px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.sb-badge{margin-left:auto;background:var(--psu-gold);color:var(--psu-blue);font-size:.63rem;font-weight:800;padding:2px 8px;border-radius:999px}

.sb-bottom{
  padding:16px 20px;
  border-top:1px solid rgba(255,255,255,.1);
  background:rgba(0,0,0,.15);
}
.sb-user{display:flex;align-items:center;gap:10px}
.sb-avatar{
  width:34px;height:34px;border-radius:50%;
  background:linear-gradient(135deg,var(--psu-gold),var(--psu-gold-deep));
  display:flex;align-items:center;justify-content:center;
  font-size:13px;font-weight:800;color:var(--psu-blue);flex-shrink:0;
  border:2px solid rgba(255,255,255,.2);
}
.sb-uname{font-size:.82rem;font-weight:700;color:#fff}
.sb-urole{font-size:.67rem;color:rgba(255,255,255,.4)}

/* ── Main ─────────────────────────────── */
.main{margin-left:var(--sw);flex:1;display:flex;flex-direction:column;min-height:100vh}

/* Topbar */
.topbar{
  height:60px;background:var(--surface);
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;
  padding:0 28px;position:sticky;top:0;z-index:50;
  box-shadow:0 1px 8px rgba(0,30,100,.06);
}
.breadcrumb{display:flex;align-items:center;gap:8px;font-size:.82rem}
.bc-root{color:var(--muted)}
.bc-sep{color:var(--muted2)}
.bc-cur{color:var(--text);font-weight:700}
.topbar-right{display:flex;align-items:center;gap:10px}
.tb-pill{
  display:flex;align-items:center;gap:6px;
  background:var(--bg);border:1px solid var(--border);
  border-radius:999px;padding:5px 14px 5px 10px;
  font-size:.75rem;font-weight:600;color:var(--muted);
}
.tb-dot{width:7px;height:7px;background:var(--green);border-radius:50%;box-shadow:0 0 0 2px var(--green-dim)}
.tb-school{font-size:.72rem;color:var(--psu-blue);font-weight:700;letter-spacing:.02em}

/* Page body */
.page-body{flex:1;padding:28px 30px 48px}

/* ── Alerts ───────────────────────────── */
.alert{
  display:flex;align-items:center;gap:10px;
  padding:12px 16px;border-radius:var(--radius-sm);
  margin-bottom:22px;font-size:.85rem;font-weight:600;
  animation:fadeDown .3s ease;
}
@keyframes fadeDown{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:none}}
.alert-success{background:var(--green-dim);border:1px solid rgba(22,163,74,.25);color:var(--green)}
.alert-error{background:var(--red-dim);border:1px solid rgba(220,38,38,.25);color:var(--red)}

/* ── Page header ─────────────────────── */
.page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:26px}
.ph-eyebrow{font-size:.67rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--psu-blue-light);margin-bottom:4px}
.ph-title{font-family:'Playfair Display',serif;font-size:2.1rem;color:var(--text);line-height:1.1}
.ph-sub{color:var(--muted);font-size:.82rem;margin-top:5px}

/* ── Buttons ──────────────────────────── */
.btn{
  display:inline-flex;align-items:center;gap:6px;
  padding:9px 20px;border-radius:var(--radius-sm);
  font-size:.82rem;font-weight:700;
  font-family:'Plus Jakarta Sans',sans-serif;
  cursor:pointer;text-decoration:none;border:none;
  transition:all .15s;letter-spacing:.01em;
}
.btn-primary{
  background:var(--psu-blue);color:#fff;
  box-shadow:0 2px 12px var(--psu-blue-glow);
}
.btn-primary:hover{background:var(--psu-blue-mid);transform:translateY(-1px);box-shadow:0 6px 20px var(--psu-blue-glow)}
.btn-gold{
  background:var(--psu-gold);color:var(--psu-blue);
  box-shadow:0 2px 12px var(--psu-gold-glow);font-weight:800;
}
.btn-gold:hover{background:var(--psu-gold-deep);transform:translateY(-1px)}
.btn-outline{background:var(--surface);color:var(--muted);border:1.5px solid var(--border2);font-weight:600}
.btn-outline:hover{color:var(--text);border-color:var(--muted2);background:var(--bg)}
.btn-danger{background:var(--red-dim);color:var(--red);border:1px solid rgba(220,38,38,.25);font-weight:600}
.btn-danger:hover{background:rgba(220,38,38,.18)}
.btn-edit{background:var(--psu-blue-dim);color:var(--psu-blue);border:1px solid rgba(0,48,135,.2);font-weight:600}
.btn-edit:hover{background:rgba(0,48,135,.14)}
.btn-sm{padding:6px 13px;font-size:.75rem}

/* ── Stats ────────────────────────────── */
.stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:26px}
.stat-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius);padding:20px 22px;
  position:relative;overflow:hidden;
  transition:box-shadow .2s,border-color .2s;
}
.stat-card:hover{box-shadow:0 4px 20px rgba(0,30,100,.08);border-color:var(--border2)}
.stat-card::after{
  content:'';position:absolute;bottom:0;left:0;right:0;height:3px;
  background:var(--sc-bar,var(--psu-blue));border-radius:0 0 var(--radius) var(--radius);
  opacity:.6;
}
.stat-icon{
  width:36px;height:36px;border-radius:9px;
  background:var(--sc,var(--psu-blue-dim));
  display:flex;align-items:center;justify-content:center;font-size:17px;margin-bottom:12px;
}
.stat-label{font-size:.67rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:4px}
.stat-value{font-family:'Playfair Display',serif;font-size:2rem;color:var(--text);line-height:1}
.stat-trend{font-size:.72rem;color:var(--muted);margin-top:4px}

/* ── Table card ───────────────────────── */
.tcard{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;box-shadow:0 2px 12px rgba(0,30,100,.05)}
.tcard-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:16px 22px;border-bottom:1px solid var(--border);
  background:linear-gradient(90deg,#F5F8FF,var(--surface));
}
.tcard-title{font-size:.88rem;font-weight:800;color:var(--text);display:flex;align-items:center;gap:8px}
.tc-badge{background:var(--psu-blue);color:#fff;font-size:.65rem;font-weight:700;padding:2px 9px;border-radius:999px}

table{width:100%;border-collapse:collapse}
thead{background:#F5F8FF}
th{
  padding:10px 20px;text-align:left;
  font-size:.67rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;
  color:var(--psu-blue);border-bottom:2px solid var(--border);
}
td{padding:14px 20px;font-size:.85rem;border-bottom:1px solid var(--border);vertical-align:middle}
tr:last-child td{border-bottom:none}
tbody tr{transition:background .1s}
tbody tr:hover td{background:#F5F8FF}

.cell-name{font-weight:700;color:var(--text)}
.cell-email{color:var(--muted);font-size:.76rem;margin-top:2px}
.cell-num{color:var(--muted2);font-size:.75rem;font-weight:700}

.pill{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:700}
.pill-course{background:var(--psu-blue-dim);color:var(--psu-blue)}
.pill-year{background:var(--psu-gold-dim);color:var(--psu-gold-deep)}

.status-pill{display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:999px;font-size:.72rem;font-weight:700}
.s-active{background:var(--green-dim);color:var(--green)}
.s-inactive{background:var(--red-dim);color:var(--red)}
.s-leave{background:var(--amber-dim);color:var(--amber)}
.status-pill::before,.pill::before{content:'';width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0}

.row-actions{display:flex;gap:6px}

/* ── Empty ────────────────────────────── */
.empty{padding:64px 24px;text-align:center}
.empty-icon{
  width:64px;height:64px;border-radius:16px;
  background:var(--psu-blue-dim);
  display:flex;align-items:center;justify-content:center;font-size:28px;
  margin:0 auto 16px;border:2px solid rgba(0,48,135,.15);
}
.empty-t{font-family:'Playfair Display',serif;font-size:1.3rem;color:var(--text);margin-bottom:6px}
.empty-s{color:var(--muted);font-size:.85rem;margin-bottom:20px}

/* ── Form ─────────────────────────────── */
.form-wrap{max-width:720px}
.fcard{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:16px;box-shadow:0 2px 12px rgba(0,30,100,.05)}
.fcard-head{
  padding:16px 22px;border-bottom:1px solid var(--border);
  background:linear-gradient(90deg,#EEF3FF,var(--surface));
  border-left:4px solid var(--psu-blue);
}
.fcard-title{font-size:.88rem;font-weight:800;color:var(--psu-blue);display:flex;align-items:center;gap:9px}
.fcard-title .fi{
  width:28px;height:28px;background:var(--psu-blue-dim);border-radius:6px;
  display:flex;align-items:center;justify-content:center;font-size:14px;
}
.fcard-body{padding:24px}

.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.fg{display:flex;flex-direction:column;gap:6px}
.fg.span2{grid-column:span 2}

label{font-size:.78rem;font-weight:700;color:var(--text)}
label .req{color:var(--red);margin-left:2px}
label .hint{font-weight:400;color:var(--muted);margin-left:4px;font-size:.72rem}

input[type=text],input[type=email],input[type=number],input[type=tel],select{
  width:100%;background:var(--bg);border:1.5px solid var(--border2);
  border-radius:var(--radius-sm);color:var(--text);
  font-family:'Plus Jakarta Sans',sans-serif;font-size:.85rem;
  padding:9px 13px;outline:none;transition:border-color .15s,box-shadow .15s;
}
input:focus,select:focus{border-color:var(--psu-blue-light);background:var(--surface);box-shadow:0 0 0 3px var(--psu-blue-dim)}
select option{background:var(--surface)}
.input-error{border-color:var(--red)!important}
.input-error:focus{box-shadow:0 0 0 3px var(--red-dim)!important}
.err{color:var(--red);font-size:.73rem;margin-top:3px;display:flex;align-items:center;gap:4px;font-weight:600}

.form-footer{display:flex;gap:10px;padding-top:6px}

/* ── Gold divider ─────────────────────── */
.gold-divider{height:2px;background:linear-gradient(90deg,var(--psu-gold),transparent);margin:0 0 24px;border-radius:999px;width:60px}
</style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
  <div class="sb-top">
    <a href="{{ route('students.index') }}" class="sb-brand">
      <img src="{{ asset('Pangasinan_State_University_logo.png') }}" alt="PSU Seal"
     style="width:46px;height:46px;border-radius:50%;object-fit:cover;border:2px solid var(--psu-gold);">
      <div class="sb-name-wrap">
        <div class="sb-uni">Pangasinan State University</div>
        <div class="sb-app">PSU EduTrack</div>
        <div class="sb-tag">Student Management System</div>
      </div>
    </a>
  </div>

  <nav class="sb-nav">
    <div class="sb-section">Navigation</div>
    <a href="{{ route('students.index') }}"
       class="sb-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
      <span class="si">🏠</span> Dashboard
    </a>

    <div class="sb-section">Students</div>
    <a href="{{ route('students.index') }}"
       class="sb-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
      <span class="si">👥</span> All Students
    </a>
    <a href="{{ route('students.create') }}"
       class="sb-link {{ request()->routeIs('students.create') ? 'active' : '' }}">
      <span class="si">➕</span> Enroll Student
    </a>

    <div class="sb-section">System</div>
    <a href="#" class="sb-link" style="opacity:.3;pointer-events:none">
      <span class="si">📊</span> Reports
    </a>
    <a href="#" class="sb-link" style="opacity:.3;pointer-events:none">
      <span class="si">📅</span> Schedule
    </a>
    <a href="#" class="sb-link" style="opacity:.3;pointer-events:none">
      <span class="si">⚙️</span> Settings
    </a>
  </nav>

  <div class="sb-bottom">
    <div class="sb-user">
      <div class="sb-avatar">H</div>
      <div>
        <div class="sb-uname">Hazel</div>
        <div class="sb-urole">System Administrator</div>
      </div>
    </div>
  </div>
</aside>

<!-- Main -->
<div class="main">
  <header class="topbar">
    <div class="breadcrumb">
      <span class="bc-root">PSU EduTrack</span>
      <span class="bc-sep">/</span>
      <span class="bc-cur">@yield('page-title','Dashboard')</span>
    </div>
    <div class="topbar-right">
      <span class="tb-school">Pangasinan State University</span>
      <div class="tb-pill"><div class="tb-dot"></div> Online</div>
    </div>
  </header>

  <div class="page-body">
    @if(session('success'))
      <div class="alert alert-success">✅ &nbsp;{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-error">⚠️ &nbsp;Please fix the errors below before saving.</div>
    @endif

    @yield('content')
  </div>
</div>

</body>
</html>
