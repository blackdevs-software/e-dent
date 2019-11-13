<?php
include_once('check_session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Consultas">
  <meta name="keyword" content="Web System, Odontologic System, Dentist">
  <title>Consultas</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="images/icons/iconEdent.png"/>
</head>

<body>
  <section id="container">
    <header class="header" style="background-color: #111; border-bottom: #fff 1px solid;">
      <div class="toggle-nav" style="margin-top: 15px;">
        <div class="icon-reorder tooltips" data-original-title="Menu lateral" data-placement="bottom">
        <i class="fas fa-bars" style="color: #fff;"></i>
      </div>
      </div>
      <a class="navbar-brand" href="login.php">
        <img src="images/icons/E-DENT-3.png" class="nav-item" alt="logo" style="width: 90px">
      </a>
    </header>

    <?php
      include('aside.php');
    ?>

    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                CONSULTAS
              </header>

              <div class="row" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="align-center">
                  <h2>Selecione um dia para consulta</h2>
                </div>
                <br>
                <div id='calendar' style="width: 40%; max-height: 40%; height: auto;"></div>
              </div>
            </section>
          </div>
        </div>
      </section>
    </section>
  </section>

  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="js/jquery.customSelect.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="js/scripts.js"></script>

  <script src="js/moment.min.js"></script>

  <link href="assets/fullcalendar/packages/core/main.css" rel="stylesheet" />
  <link href="assets/fullcalendar/packages/daygrid/main.css" rel="stylesheet" />
  <link href="assets/fullcalendar/packages/timegrid/main.css" rel="stylesheet" />
  <link href="assets/fullcalendar/packages/list/main.css" rel="stylesheet" />
  <script src="assets/fullcalendar/packages/core/main.js"></script>
  <script src="assets/fullcalendar/packages/core/locales-all.js"></script>
  <script src="assets/fullcalendar/packages/interaction/main.js"></script>
  <script src="assets/fullcalendar/packages/daygrid/main.js"></script>
  <script src="assets/fullcalendar/packages/timegrid/main.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const initialLocaleCode = 'pt-br';
      const calendarEl = document.getElementById('calendar');

      const calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth, timeGridWeek, timeGridDay',
        },
        defaultDate: moment().format('YYYY-MM-DD'),
        locale: initialLocaleCode,
        buttonIcons: false,
        weekNumbers: false,
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        eventLimit: true,
        select: function(arg) {
          const title = prompt('Titulo:');
          if (title) {
            calendar.addEvent({
              title: title,
              start: arg.start,
              end: arg.end,
              allDay: arg.allDay,
            });
          }
          calendar.unselect();
        },
        eventDrop: function(context) {
          alert(context.event.title + moment(context.event.start).format('YYYY-MM-DD'));
          if (!confirm('Tem certeza que deseja alterar?')) {
            context.revert();
          }
        },
        events: [
          {
            title: 'Evento',
            start: moment().add(1, 'days').format('YYYY-MM-DD'),
            end: moment().add(1, 'days').format('YYYY-MM-DD'),
          },
        ],
      });

      calendar.render();
    });
  </script>
</body>

</html>
