@extends('layouts.app')
@section('page-title','All Students')

@section('content')

<div class="page-header">
  <div>
    <div class="ph-eyebrow">Pangasinan State University</div>
    <h1 class="ph-title">Student Records</h1>
    <p class="ph-sub">Manage and monitor all enrolled students of PSU</p>
  </div>
  <a href="{{ route('students.create') }}" class="btn btn-gold">
    ＋ &nbsp;Enroll Student
  </a>
</div>

{{-- Stats --}}
<div class="stats-grid">
  <div class="stat-card" style="--sc:var(--psu-blue-dim);--sc-bar:var(--psu-blue)">
    <div class="stat-icon">👥</div>
    <div class="stat-label">Total Students</div>
    <div class="stat-value">{{ $stats['total'] }}</div>
    <div class="stat-trend">All enrolled records</div>
  </div>
  <div class="stat-card" style="--sc:var(--green-dim);--sc-bar:var(--green)">
    <div class="stat-icon">✅</div>
    <div class="stat-label">Active</div>
    <div class="stat-value">{{ $stats['active'] }}</div>
    <div class="stat-trend">Currently enrolled</div>
  </div>
  <div class="stat-card" style="--sc:var(--psu-gold-dim);--sc-bar:var(--psu-gold)">
    <div class="stat-icon">📊</div>
    <div class="stat-label">Average Age</div>
    <div class="stat-value">{{ $stats['avg_age'] ?? '—' }}</div>
    <div class="stat-trend">Across all students</div>
  </div>
  <div class="stat-card" style="--sc:rgba(0,98,204,.08);--sc-bar:var(--psu-blue-light)">
    <div class="stat-icon">📚</div>
    <div class="stat-label">Programs</div>
    <div class="stat-value">{{ $stats['courses'] }}</div>
    <div class="stat-trend">Unique courses</div>
  </div>
</div>

{{-- Table --}}
<div class="tcard">
  <div class="tcard-head">
    <div class="tcard-title">
      🎓 &nbsp;Enrolled Students
      <span class="tc-badge">{{ $students->count() }} records</span>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">+ Enroll New</a>
  </div>

  @if($students->isEmpty())
    <div class="empty">
      <div class="empty-icon">🦁</div>
      <div class="empty-t">No students enrolled yet</div>
      <p class="empty-s">Start by enrolling the first PSU student.</p>
      <a href="{{ route('students.create') }}" class="btn btn-gold">Enroll First Student</a>
    </div>
  @else
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Student</th>
          <th>Course</th>
          <th>Year & Section</th>
          <th>Age</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($students as $s)
        <tr>
          <td class="cell-num">{{ $loop->iteration }}</td>
          <td>
            <div class="cell-name">{{ $s->name }}</div>
            <div class="cell-email">{{ $s->email }}{{ $s->phone ? ' · '.$s->phone : '' }}</div>
          </td>
          <td><span class="pill pill-course">{{ $s->course }}</span></td>
          <td><span class="pill pill-year">{{ $s->year_level }}{{ $s->section ? ' – '.$s->section : '' }}</span></td>
          <td style="font-weight:700;color:var(--text)">{{ $s->age }}</td>
          <td>
            @if($s->status === 'Active')
              <span class="status-pill s-active">Active</span>
            @elseif($s->status === 'Inactive')
              <span class="status-pill s-inactive">Inactive</span>
            @else
              <span class="status-pill s-leave">On Leave</span>
            @endif
          </td>
          <td>
            <div class="row-actions">
              <a href="{{ route('students.edit', $s) }}" class="btn btn-edit btn-sm">✏ Edit</a>
              <form action="{{ route('students.destroy', $s) }}" method="POST"
                    onsubmit="return confirm('Remove {{ $s->name }} from records? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">🗑 Remove</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>

@endsection
