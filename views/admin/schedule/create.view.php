<?php include 'views/partials/head.php'; ?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<h1>Manage Schedules</h1>

<form method="GET" style="margin-bottom:1rem;">
  <label for="schoolYear">School Year:</label>
  <select name="school_year_id" id="schoolYear">
    <option value="">-- Choose Year --</option>
    <?php foreach ($schoolYears as $sy): ?>
      <option value="<?= $sy['id'] ?>"><?= $sy['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <label for="semester">Semester:</label>
  <select name="semester_id" id="semester">
    <option value="">-- Choose Semester --</option>
    <?php foreach ($semesters as $sem): ?>
      <option value="<?= $sem['id'] ?>" data-sy="<?= $sem['sy_id'] ?>">
        <?= $sem['label'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label for="program">Program:</label>
  <select name="program_id" id="program">
    <option value="">-- Choose Program --</option>
    <?php foreach ($programs as $prog): ?>
      <option value="<?= $prog['id'] ?>" data-deptid="<?= $prog['department_id'] ?>">
        <?= $prog['name'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label for="department">Department:</label>
  <select name="department_id" id="department">
    <option value="">-- Department --</option>
    <?php foreach ($departments as $dept): ?>
      <option value="<?= $dept['id'] ?>"><?= $dept['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <label for="faculty">Faculty:</label>
  <select name="faculty_id" id="faculty">
    <option value="">-- Choose Faculty --</option>
    <?php foreach ($faculties as $f): ?>
      <option value="<?= $f['id'] ?>">
        <?= $f['lastname'] . ', ' . $f['firstname'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label for="subject">Subject:</label>
  <select name="subject_id" id="subject">
    <option value="">-- Choose Subject --</option>
    <?php foreach ($subjects as $sub): ?>
      <option value="<?= $sub['id'] ?>">
        <?= $sub['code'] ?> - <?= $sub['description'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label for="section">Section:</label>
  <select name="section_id" id="section">
    <option value="">-- Choose Section --</option>
    <?php foreach ($sections as $sec): ?>
      <option value="<?= $sec['id'] ?>"><?= $sec['section'] ?></option>
    <?php endforeach; ?>
  </select>

  <label for="room">Room:</label>
  <select name="room_id" id="room">
    <option value="">-- Choose Room --</option>
    <?php foreach ($rooms as $r): ?>
      <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit" style="margin-left:1rem;">Filter Schedules</button>
</form>

<script>
  $('#program').on('change', function() {
    const deptId = $(this).find(':selected').data('deptid');
    $('#department').val(deptId || '');
  });

  document.addEventListener('DOMContentLoaded', () => {
    const dropdowns = [
      'schoolYear', 'semester', 'program', 'department',
      'faculty', 'subject', 'section', 'room'
    ];
    dropdowns.forEach(id => {
      const el = document.getElementById(id);
      if (el) {
        const savedValue = localStorage.getItem(id);
        if (savedValue !== null) {
          el.value = savedValue;
        }
        el.addEventListener('change', () => {
          localStorage.setItem(id, el.value);
        });
      }
    });
  });
</script>

<style>
  .timetable-container {
    user-select: none;
    width: 100%;
    max-width: 900px;
    border: 1px solid #ccc;
    margin-bottom: 1rem;
  }
  .timetable-row {
    display: flex;
    border-bottom: 1px solid #ccc;
  }
  .time-label {
    width: 120px;
    min-width: 120px;
    border-right: 1px solid #ccc;
    padding: 4px;
    font-size: 0.9rem;
    text-align: right;
    background: #f7f7f7;
  }
  .day-cell {
    flex: 1;
    border-right: 1px solid #ccc;
    height: 32px;
    position: relative;
    cursor: pointer;
  }
  .day-cell:hover {
    background-color: #f2f2f2;
  }
  .selected {
    background-color: #c3d9ff;
  }
  .day-header {
    text-align: center;
    background: #eaeaea;
    padding: 4px;
    border-right: 1px solid #ccc;
    font-weight: bold;
    flex: 1;
  }
  .timetable-row:last-child {
    border-bottom: none;
  }
</style>

<div id="timetable" class="timetable-container">
  <div class="timetable-row">
    <div class="time-label"></div>
    <div class="day-header">Mon</div>
    <div class="day-header">Tue</div>
    <div class="day-header">Wed</div>
    <div class="day-header">Thu</div>
    <div class="day-header">Fri</div>
  </div>
  <?php
    $timeSlots = [];
    $start = strtotime('7:30 am');
    $end   = strtotime('5:00 pm');
    while ($start < $end) {
      $slotStart = date('g:i a', $start);
      $slotEnd   = date('g:i a', $start + 1800);
      $timeSlots[] = [$slotStart, $slotEnd];
      $start += 1800;
    }
  ?>
  <?php foreach ($timeSlots as $slot): ?>
    <div class="timetable-row">
      <div class="time-label">
        <?= $slot[0] . ' - ' . $slot[1] ?>
      </div>
      <?php $days = ['Mon','Tue','Wed','Thu','Fri']; ?>
      <?php foreach ($days as $day): ?>
        <div
          class="day-cell"
          data-day="<?= $day ?>"
          data-start="<?= $slot[0] ?>"
          data-end="<?= $slot[1] ?>"
        ></div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

<div>
  <strong>Selected Day:</strong> <span id="selectedDay">—</span><br>
  <strong>Start Time:</strong> <span id="startTime">—</span><br>
  <strong>End Time:</strong> <span id="endTime">—</span>
</div>

<form method="post" action="/admin/schedule/create" style="margin-top:1rem;">
  <input type="hidden" name="faculty_id"   id="inputFacultyId">
  <input type="hidden" name="subject_id"   id="inputSubjectId">
  <input type="hidden" name="section_id"   id="inputSectionId">
  <input type="hidden" name="room_id"      id="inputRoomId">
  <input type="hidden" name="semester_id"  id="inputSemesterId">
  <input type="hidden" name="day"          id="inputDay">
  <input type="hidden" name="start_time"   id="inputStartTime">
  <input type="hidden" name="end_time"     id="inputEndTime">

  <label for="class_type">Class Type:</label>
  <select name="class_type" id="class_type">
    <option value="lecture">Lecture</option>
    <option value="lab">Lab</option>
  </select>

  <button type="submit" id="saveScheduleBtn">Save Schedule</button>
</form>

<script>
function parseTimeStringToMinutes(timeStr) {
  const [hms, ampm] = timeStr.split(' ');
  const [h, m] = hms.split(':');
  let hour = parseInt(h, 10);
  const minute = parseInt(m, 10);
  if (ampm === 'pm' && hour !== 12) hour += 12;
  if (ampm === 'am' && hour === 12) hour = 0;
  return hour * 60 + minute;
}

const timetable   = document.getElementById('timetable');
const selectedDay = document.getElementById('selectedDay');
const startTime   = document.getElementById('startTime');
const endTime     = document.getElementById('endTime');

const inputDay        = document.getElementById('inputDay');
const inputStartTime  = document.getElementById('inputStartTime');
const inputEndTime    = document.getElementById('inputEndTime');
const inputFacultyId  = document.getElementById('inputFacultyId');
const inputSubjectId  = document.getElementById('inputSubjectId');
const inputSectionId  = document.getElementById('inputSectionId');
const inputRoomId     = document.getElementById('inputRoomId');
const inputSemesterId = document.getElementById('inputSemesterId');

let isMouseDown = false;
let startCell   = null;
let currentDay  = null;
let selectedCells = [];

function clearSelection() {
  selectedCells.forEach(cell => cell.classList.remove('selected'));
  selectedCells = [];
  selectedDay.textContent = '—';
  startTime.textContent   = '—';
  endTime.textContent     = '—';
  inputDay.value          = '';
  inputStartTime.value    = '';
  inputEndTime.value      = '';
}

timetable.addEventListener('mousedown', (e) => {
  if (e.target.classList.contains('day-cell')) {
    e.preventDefault();
    clearSelection();
    isMouseDown = true;
    startCell   = e.target;
    currentDay  = startCell.getAttribute('data-day');
    startCell.classList.add('selected');
    selectedCells.push(startCell);
  }
});

timetable.addEventListener('mouseover', (e) => {
  if (isMouseDown && e.target.classList.contains('day-cell')) {
    if (e.target.getAttribute('data-day') === currentDay) {
      e.target.classList.add('selected');
      if (!selectedCells.includes(e.target)) {
        selectedCells.push(e.target);
      }
    }
  }
});

timetable.addEventListener('mouseup', () => {
  if (isMouseDown && selectedCells.length > 0) {
    isMouseDown = false;
    selectedCells.sort((a, b) => {
      const t1 = parseTimeStringToMinutes(a.getAttribute('data-start'));
      const t2 = parseTimeStringToMinutes(b.getAttribute('data-start'));
      return t1 - t2;
    });
    const day   = selectedCells[0].getAttribute('data-day');
    const sTime = selectedCells[0].getAttribute('data-start');
    const eTime = selectedCells[selectedCells.length - 1].getAttribute('data-end');
    selectedDay.textContent = day;
    startTime.textContent   = sTime;
    endTime.textContent     = eTime;
    inputDay.value         = day;
    inputStartTime.value   = sTime;
    inputEndTime.value     = eTime;
  }
});

timetable.addEventListener('mouseleave', () => {
  if (isMouseDown) {
    isMouseDown = false;
  }
});

document.getElementById('saveScheduleBtn').addEventListener('click', function(e){
  if (!inputDay.value) {
    e.preventDefault();
    alert('Please select a day/time range on the timetable before saving.');
    return;
  }
  const facultyVal  = localStorage.getItem('faculty')   || '';
  const subjectVal  = localStorage.getItem('subject')   || '';
  const sectionVal  = localStorage.getItem('section')   || '';
  const roomVal     = localStorage.getItem('room')      || '';
  const semesterVal = localStorage.getItem('semester')  || '';
  inputFacultyId.value  = facultyVal;
  inputSubjectId.value  = subjectVal;
  inputSectionId.value  = sectionVal;
  inputRoomId.value     = roomVal;
  inputSemesterId.value = semesterVal;

  if (!facultyVal || !subjectVal || !sectionVal || !roomVal || !semesterVal) {
    e.preventDefault();
    alert('Please choose Faculty, Subject, Section, Room, and Semester first.');
  }
});
</script>

<?php include 'views/partials/foot.php'; ?>
