<?php include 'views/partials/head.php'; ?>

<!-- Include jQuery & jQuery UI (adjust versions/CDN URLs as needed) -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<?php
$viewTypeSelected = $_GET['viewType'] ?? '';
$selectedId       = $_GET['selectedId'] ?? '';
?>

<h1>Manage Schedules (Autocomplete)</h1>

<form method="GET" action="/admin/schedules" style="margin-bottom:1rem;">
  <label for="viewType">View By:</label>
  <select name="viewType" id="viewType" required>
    <option value="">-- Choose One --</option>
    <option value="faculty" <?= $viewTypeSelected === 'faculty' ? 'selected' : '' ?>>Faculty</option>
    <option value="section" <?= $viewTypeSelected === 'section' ? 'selected' : '' ?>>Section</option>
    <option value="room"    <?= $viewTypeSelected === 'room'    ? 'selected' : '' ?>>Room</option>
  </select>

  <label for="autocompleteInput">Search:</label>
  <input type="text" id="autocompleteInput" />
  
  <!-- Hidden input to store the chosen ID -->
  <input type="hidden" id="hiddenId" name="selectedId" value="<?= htmlspecialchars($selectedId) ?>" />

  <button type="submit">Display</button>
</form>

<script>
  // These arrays are populated from your controller (already fetched from DB).
  const facultiesData = <?= json_encode($faculties) ?>;
  const sectionsData  = <?= json_encode($sections) ?>;
  const roomsData     = <?= json_encode($rooms) ?>;

  const viewTypeSelected = '<?= $viewTypeSelected ?>';
  const storedId         = '<?= $selectedId ?>';

  let currentData = [];

  function rebuildData(type) {
    if (type === 'faculty') {
      return facultiesData.map(f => ({
        label: f.lastname + ', ' + f.firstname,
        value: f.id
      }));
    } else if (type === 'section') {
      return sectionsData.map(s => ({
        label: s.section,
        value: s.id
      }));
    } else if (type === 'room') {
      return roomsData.map(r => ({
        label: r.name,
        value: r.id
      }));
    }
    return [];
  }

  $('#autocompleteInput').autocomplete({
    minLength: 0,
    source: currentData,
    select: function(event, ui) {
      event.preventDefault();
      $('#autocompleteInput').val(ui.item.label);
      $('#hiddenId').val(ui.item.value);
    },
    focus: function(event, ui) {
      event.preventDefault();
      $('#autocompleteInput').val(ui.item.label);
    }
  });

  function updateAutocomplete(type) {
    currentData = rebuildData(type);
    $('#autocompleteInput').autocomplete('option', 'source', currentData);
  }

  updateAutocomplete(viewTypeSelected);

  if (storedId) {
    const found = currentData.find(item => String(item.value) === String(storedId));
    if (found) {
      $('#autocompleteInput').val(found.label);
    }
  }

  $('#viewType').on('change', function() {
    updateAutocomplete(this.value);
    $('#autocompleteInput').val('');
    $('#hiddenId').val('');
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

<!-- Timetable -->
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
    $timeSlots[] = ['7:30 am', '8:30 am'];
    $start = strtotime('8:30 am');
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

<!-- Selected Range -->
<div>
  <strong>Selected Day:</strong> <span id="selectedDay">—</span><br>
  <strong>Start Time:</strong> <span id="startTime">—</span><br>
  <strong>End Time:</strong> <span id="endTime">—</span>
</div>

<script>
const timetable = document.getElementById('timetable');
let isMouseDown = false;
let startCell   = null;
let currentDay  = null;
let selectedCells = [];

function clearSelection() {
  selectedCells.forEach(cell => cell.classList.remove('selected'));
  selectedCells = [];
  document.getElementById('selectedDay').textContent = '—';
  document.getElementById('startTime').textContent   = '—';
  document.getElementById('endTime').textContent     = '—';
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
      const t1 = a.getAttribute('data-start');
      const t2 = b.getAttribute('data-start');
      return t1.localeCompare(t2);
    });
    const day   = selectedCells[0].getAttribute('data-day');
    const sTime = selectedCells[0].getAttribute('data-start');
    const eTime = selectedCells[selectedCells.length - 1].getAttribute('data-end');
    document.getElementById('selectedDay').textContent = day;
    document.getElementById('startTime').textContent   = sTime;
    document.getElementById('endTime').textContent     = eTime;
  }
});

timetable.addEventListener('mouseleave', () => {
  if (isMouseDown) {
    isMouseDown = false;
  }
});
</script>

<?php include 'views/partials/foot.php'; ?>
