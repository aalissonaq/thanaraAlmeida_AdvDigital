<?php
date_default_timezone_set('America/Fortaleza');
// require dirname(__DIR__, 1) . '/vendor/autoload.php';

// require '../date/connection.php';
// require '../util/util.php';
// require '../date/outfunc.php';

// $connection = novaConexao();



/*$sql = "SELECT * FROM person
        INNER JOIN projects
        ON person.id = projects.id_person_client
        INNER JOIN types_project
        ON projects.id_type_project = types_project.id
        WHERE projects.uuid = '{$_GET['id']}'";*/

// $sql = "SELECT * FROM vw_proposal
//         WHERE uuid = '{$_GET['id']}'";
// $result = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// $refer = $result[0];

// echo "<pre>";
// //print_r($refer);
// echo "</pre>";

/*
$sql = "SELECT * FROM person
        INNER JOIN projects
        ON person.id = projects.id_person_client
        WHERE person.id = '{$_GET['idcliente']}'";
$result = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);

$uuid = $_GET['uuid'];
$sql = "SELECT * FROM projects WHERE uuid = '112abf8b-6343-46ce-8ab3-1f584e2e6c71'";
$result = $connection->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$refer = $result[0];
* *************************** */
?>
<html>

<head>

  <style>
    @page {
      padding: 0px 0px;
      padding-top: 400px;
      padding-bottom: 30px;
      /* margin: 0px 0px; */
    }

    #header {
      position: fixed;
      left: 0px;
      top: -130px;
      right: 0px;
      height: 275px;
      background: transparent;
      /* background-image: url('<?= dirname(__DIR__, 1) ?>/pdfs/bg_pt.png');
      background-repeat: no-repeat;
      background-size: cover; */
      z-index: -1;
    }


    #footer {
      position: fixed;
      left: 0px;
      bottom: -150px;
      right: 0px;
      height: 310px;
      /* opacity: 0.6;
      background-image: url('<?= dirname(__DIR__, 1) ?>/pdfs/bg_pt1.png');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: bottom center; */
      z-index: -1;
    }


    #footer .page:after {
      content: counter(page, georgian);
    }

    #content {
      position: relative;
      left: 18%;
      width: 85%;
      box-sizing: border-box;
    }

    #conteudo {
      position: relative;
      top: 160;
      width: 90%;
      box-sizing: border-box;

      border: #212761 1px solid;
    }



    .title {
      font-size: 25px;
      color: darkorange;
      margin-top: 4rem;
      text-align: right;
    }

    .title_p1 {
      font-size: 15px;
      color: #212761;
      margin-top: 4rem;
      text-align: right;
    }

    .dtCapa {
      position: fixed;
      bottom: 5px;
      left: 30%;
      text-align: center;
      color: darkorange;
    }

    #table_material tbody tr:nth-child(2n+2) {
      background: #FFE4B5;
      opacity: 0.4;
    }
  </style>

<body style="background-image: url(<?= dirname(__DIR__, 1) ?>/pdfs/bg_pt.png); background-repeat: no-repeat; background-size:565pt 842pt;">
  <div id="header">
  </div>
  <div id="footer">
    <p class="page">
    </p>
  </div>

  <div id="content">
    <div id="conteudo">
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>

      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>
      <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro aperiam quisquam, molestias assumenda sapiente laudantium architecto maxime tempore repellat reprehenderit? Voluptate ab voluptatem, dolores quas inventore qui sequi laudantium voluptas.
      </p>

    </div>


  </div>
</body>

</html>
