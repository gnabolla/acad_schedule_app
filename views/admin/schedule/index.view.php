<?php include 'views/partials/head.php'; ?>

<h1>Manage Schedules</h1>

<!-- 
    Master-data-based dropdowns for filtering.
    These $faculties, $sections, $rooms, etc. 
    should be fetched in your controller before loading the view.
-->
<form method="GET" action="/admin/schedules" style="margin-bottom:1rem;">
  <label for="viewType">View By:</label>
  <select name="viewType" id="viewType" required>
    <option value="">-- Choose One --</option>
    <option value="faculty">Faculty</option>
    <option value="section">Section</option>
    <option value="room">Room</option>
  </select>

  <!-- 
      Second dropdown is dynamically populated 
      depending on the first selection 
      (in real usage, either do it via JavaScript or with a separate submission).
  -->
  <label for="selectedId">Select:</label>
  <select name="selectedId" id="selectedId" required>
    <option value="">-- Select --</option>
    <!-- 
        Example: if you want to show faculties:
        <?php foreach ($faculties as $f): ?>
            <option value="<?= $f['id'] ?>">
                <?= htmlspecialchars($f['firstname'].' '.$f['lastname']) ?>
            </option>
        <?php endforeach; ?>
        
        You'd normally filter or change these options 
        based on whether user chose "faculty"/"section"/"room."
    -->
  </select>

  <button type="submit">Display</button>
</form>

<!-- 
    Timetable from 7:30 AM - 8:30 AM (1 hour block),
    then 8:30 AM - 5:00 PM in 30-minute increments
-->

<style>
  .timetable-container {
    user-select: none; /* Prevents text highlighting during drag */
    width: 100%;
    max-width: 900px;
    border: 1px solid #ccc;
    margin-bottom: 1rem;
  }
  .timetable-row {
    display: flex;
    border-bottom: 1px solid #eee;
  }
  .time-label {
    width: 120px;
    min-width: 120px;
    border-right: 1px solid #ccc;
    padding: 4px;
    font-size: 0.9rem;
    text-align: right;
    background: #fafafa;
  }
  .day-cell {
    flex: 1;
    border-right: 1px solid #ddd;
    height: 32px; /* each slot row height */
    position: relative;
    cursor: pointer;
  }
  .day-cell:hover {
    background-color: #f5f5f5;
  }
  .selected {
    background-color: #a7d4fd !important; 
  }
  .day-header {
    text-align: center;
    background: #f0f0f0;
    padding: 4px;
    border-right: 1px solid #ccc;
    font-weight: bold;
    flex:1;
  }
  /* Last row border fix */
  .timetable-row:last-child {
    border-bottom: none;
  }
</style>

<!-- 
    The clickable + draggable time slots.
    In a real application, you might also highlight cells
    that are already scheduled for the selected faculty/section/room.
-->
<div id="timetable" class="timetable-container">
  <!-- Header row (days) -->
  <div class="timetable-row">
    <div class="time-label"></div>
    <div class="day-header">Mon</div>
    <div class="day-header">Tue</div>
    <div class="day-header">Wed</div>
    <div class="day-header">Thu</div>
    <div class="day-header">Fri</div>
  </div>

  <?php
    // Build custom timeslots:
    //  1) 7:30 am - 8:30 am
    //  2) Then 8:30 am - 9:00 am, 9:00 - 9:30, ... until 5:00 pm
    // We will store them in an array of [start, end]
    $timeSlots = [];
    // First slot: 7:30 - 8:30
    $timeSlots[] = ['7:30 am', '8:30 am'];

    // Now 8:30 - 17:00 in 30-min increments
    $start = strtotime('8:30 am');
    $end   = strtotime('5:00 pm');
    while ($start < $end) {
      $slotStart = date('g:i a', $start);
      $slotEnd   = date('g:i a', $start + 30*60);
      $timeSlots[] = [$slotStart, $slotEnd];
      $start += 30*60;
    }
  ?>

  <?php foreach ($timeSlots as $slot): ?>
    <div class="timetable-row">
      <!-- Left label: e.g., "7:30 am - 8:30 am" -->
      <div class="time-label">
        <?= $slot[0] . ' - ' . $slot[1] ?>
      </div>

      <!-- 5 days (Mon-Fri) -->
      <?php $days = ['Mon','Tue','Wed','Thu','Fri']; ?>
      <?php foreach ($days as $day): ?>
        <div 
          class="day-cell" 
          data-day="<?= $day ?>" 
          data-start="<?= $slot[0] ?>" 
          data-end="<?= $slot[1] ?>"
        >
          <!-- If you want to display scheduled items for this slot, insert them here -->
        </div>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
</div>

<!-- Show selected day/time after user click-drag -->
<div>
  <strong>Selected Day:</strong> <span id="selectedDay">—</span><br>
  <strong>Start Time:</strong> <span id="startTime">—</span><br>
  <strong>End Time:</strong> <span id="endTime">—</span>
</div>

<script>
// Basic click+drag to select time range in a single column
const timetable = document.getElementById('timetable');
let isMouseDown = false;
let startCell = null;
let currentDay = null;
let selectedCells = [];

// Clears old selection
function clearSelection() {
  selectedCells.forEach(cell => cell.classList.remove('selected'));
  selectedCells = [];
  document.getElementById('selectedDay').textContent = '—';
  document.getElementById('startTime').textContent = '—';
  document.getElementById('endTime').textContent = '—';
}

timetable.addEventListener('mousedown', (e) => {
  if (e.target.classList.contains('day-cell')) {
    e.preventDefault();  // prevent text highlight
    clearSelection();
    isMouseDown = true;
    startCell = e.target;
    currentDay = startCell.getAttribute('data-day');
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
    // Sort selected cells by start time
    selectedCells.sort((a, b) => {
      const t1 = a.getAttribute('data-start');
      const t2 = b.getAttribute('data-start');
      return t1.localeCompare(t2);
    });
    // Use the first cell as the earliest, last cell as the latest
    const day = selectedCells[0].getAttribute('data-day');
    const sTime = selectedCells[0].getAttribute('data-start');
    const eTime = selectedCells[selectedCells.length - 1].getAttribute('data-end');
    document.getElementById('selectedDay').textContent = day;
    document.getElementById('startTime').textContent = sTime;
    document.getElementById('endTime').textContent = eTime;
  }
});

// If user leaves the timetable area while dragging, end selection
timetable.addEventListener('mouseleave', () => {
  if (isMouseDown) {
    isMouseDown = false;
  }
});
</script>

<?php include 'views/partials/foot.php'; ?>
