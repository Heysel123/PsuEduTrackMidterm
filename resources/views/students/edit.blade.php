@extends('layouts.app')
@section('page-title','Edit Student')

@section('content')

<div class="page-header">
  <div>
    <div class="ph-eyebrow">Pangasinan State University</div>
    <h1 class="ph-title">Edit Student</h1>
    <p class="ph-sub">Updating record for <strong style="color:var(--psu-blue)">{{ $student->name }}</strong></p>
  </div>
  <a href="{{ route('students.index') }}" class="btn btn-outline">← Back to Records</a>
</div>

<div class="form-wrap">
  <form action="{{ route('students.update', $student) }}" method="POST" id="editForm">
  @csrf @method('PUT')

  <div class="fcard">
    <div class="fcard-head">
      <div class="fcard-title"><span class="fi">👤</span> Personal Information</div>
    </div>
    <div class="fcard-body">
      <div class="form-grid">

        <div class="fg span2">
          <label>Full Name <span class="req">*</span></label>
          <input type="text" name="name" value="{{ old('name', $student->name) }}"
            class="{{ $errors->has('name') ? 'input-error' : '' }}" autofocus>
          @error('name')<div class="err">⚠ {{ $message }}</div>@enderror
        </div>

        <div class="fg span2">
          <label>Email Address <span class="req">*</span></label>
          <input type="email" name="email" value="{{ old('email', $student->email) }}"
            class="{{ $errors->has('email') ? 'input-error' : '' }}">
          @error('email')<div class="err">⚠ {{ $message }}</div>@enderror
        </div>

        <div class="fg">
          <label>Age <span class="req">*</span></label>
          <input type="number" name="age" value="{{ old('age', $student->age) }}" min="15" max="80">
          @error('age')<div class="err">⚠ {{ $message }}</div>@enderror
        </div>

        <div class="fg">
          <label>Phone Number</label>
          <input type="tel" name="phone" value="{{ old('phone', $student->phone) }}" placeholder="e.g. 09171234567">
        </div>

      </div>
    </div>
  </div>

  <div class="fcard">
    <div class="fcard-head">
      <div class="fcard-title"><span class="fi">📚</span> Academic Information</div>
    </div>
    <div class="fcard-body">
      <div class="form-grid">

        <div class="fg span2">
          <label>Course / Program <span class="req">*</span></label>
          <select name="course">
            @php
            $courses = [
              'College of Information & Communication Technology' => [
                'Bachelor of Science in Information Technology',
                'Bachelor of Science in Computer Science',
                'Bachelor of Science in Computer Engineering',
              ],
              'College of Education' => [
                'Bachelor of Secondary Education',
                'Bachelor of Elementary Education',
                'Bachelor of Physical Education',
              ],
              'College of Engineering & Architecture' => [
                'Bachelor of Science in Civil Engineering',
                'Bachelor of Science in Electrical Engineering',
                'Bachelor of Science in Mechanical Engineering',
              ],
              'College of Business & Accountancy' => [
                'Bachelor of Science in Accountancy',
                'Bachelor of Science in Business Administration',
                'Bachelor of Science in Hospitality Management',
                'Bachelor of Science in Tourism Management',
              ],
              'College of Arts & Sciences' => [
                'Bachelor of Arts in Communication',
                'Bachelor of Science in Psychology',
                'Bachelor of Science in Social Work',
              ],
              'College of Health Sciences' => [
                'Bachelor of Science in Nursing',
                'Bachelor of Science in Medical Technology',
                'Bachelor of Science in Pharmacy',
              ],
            ];
            @endphp
            @foreach($courses as $college => $programs)
              <optgroup label="{{ $college }}">
                @foreach($programs as $prog)
                  <option value="{{ $prog }}" {{ old('course', $student->course) == $prog ? 'selected' : '' }}>{{ $prog }}</option>
                @endforeach
              </optgroup>
            @endforeach
          </select>
          @error('course')<div class="err">⚠ {{ $message }}</div>@enderror
        </div>

        <div class="fg">
          <label>Year Level <span class="req">*</span></label>
          <select name="year_level">
            @foreach(['1st Year','2nd Year','3rd Year','4th Year','5th Year'] as $y)
              <option value="{{ $y }}" {{ old('year_level', $student->year_level) == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
          </select>
        </div>

        <div class="fg">
          <label>Section</label>
          <input type="text" name="section" value="{{ old('section', $student->section) }}" placeholder="e.g. A">
        </div>

        <div class="fg">
          <label>Enrollment Status <span class="req">*</span></label>
          <select name="status">
            @foreach(['Active','Inactive','On Leave'] as $st)
              <option value="{{ $st }}" {{ old('status', $student->status) == $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
          </select>
        </div>

      </div>

      <div class="form-footer" style="margin-top:20px">
        <button type="submit" class="btn btn-gold">💾 &nbsp;Save Changes</button>
        <a href="{{ route('students.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </div>
  </div>

  </form>
</div>
@endsection
