<?php 

  if ($_GET==null || $_GET=="" || $_GET=="0"   ) {
    $id="";
  } else {
    $id=$_GET['id'];
  }

  // OBTENER TODOS LOS POKEMON

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://pokeapi.co/api/v2/pokemon/?offset=0&limit=148",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $response=json_decode($response);
   
  }

  

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- TITULO -->
      <title>POKEMON</title>

    <!-- LIBRERIAS DE BOOTSTRAP -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>         

    <!-- LIBRERIAS DE ICONOS -->
      <link rel="stylesheet" href="libraries/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- LIBRERIAS DE SELECT2 -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

      <!-- ESTILOS -->
      <link rel="stylesheet" type="text/css" href="css/styles.css">


      <!-- VOLVER -->
      <script type="text/javascript">
        function historial() {
          history.pushState({data:true}, 'Titulo', 'index.php');
          location.reload();
        }
      </script>

  </head>

  <body>
    <nav class="navbar navbar-danger bg-danger">
      <a class="navbar-brand" onclick="historial();" style="color: #fff;"><i class="fa fa-arrow-left" aria-hidden="true"></i> VOLVER</a>
      <div class="form-inline">
        <select id="mi-selector" class="form-group col-md-12">
            <option selected disabled>Buscar Pokemon...</option> 
            <?php for ($i=0; $i < count($response->results); $i++) { ?>
                      <option value='<?php echo $response->results[$i]->name; ?>'><?php echo $response->results[$i]->name; ?> </option>    
            <?php   } ?> 
        </select>
      </div>
    </nav>

    <?php if ($id==""): ?>
      <div class="container1">
        <div class="form-row">
          <div class="col-md-12">
            <img src="img/1.png" width="40%"><br><br>
          </div>

          <div class="col-md-2">
            <select id="mi-selector2" class="form-control col-md-12">
              <option selected disabled>Buscar Pokemon...</option> 
              <?php for ($i=0; $i < count($response->results); $i++) { ?>
                        <option value='<?php echo $response->results[$i]->name; ?>'><?php echo $response->results[$i]->name; ?> </option>    
              <?php   } ?> 
            </select>
          </div>  
          <div class="col-md-12"  style="text-align: end;margin-left: -15%;">
            <img src="img/2.png" width="22%">
          </div>
        </div>
      </div>
    <?php else: 

        // BUSCAR DATOS DEL POKEMON SELECCIONADO
          $curl2 = curl_init();

          curl_setopt_array($curl2, array(
            CURLOPT_URL => "https://pokeapi.co/api/v2/pokemon/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
            ),
          ));

          $response2 = curl_exec($curl2);
          $err2 = curl_error($curl2);

          curl_close($curl2);

          if ($err2) {
            echo "cURL Error #:" . $err2;
          } else {
            $response2=json_decode($response2);
          }


        // BUSCAR INFORMACION DEL POKEMON SELECCIONADO
          $curl3 = curl_init();

          curl_setopt_array($curl3, array(
            CURLOPT_URL => "https://pokeapi.co/api/v2/pokemon-species/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache",
            ),
          ));

          $response3 = curl_exec($curl3);
          $err3 = curl_error($curl3);

          curl_close($curl3);

          if ($err3) {
            echo "cURL Error #:" . $err3;
          } else {
            $response3=json_decode($response3);
          }
?>
  
      <div class="container2">
        <br>
        <div class="card" style="border-color: #000;margin-left: 20%;margin-right: 20%;">
          <br>
            <div class="form-row">

              <div class="col-md-6">

                <div class="card" >
                  <div class="card-header" style="background-color: #dc3545!important">
                    <div class="form-row col-md-12">
                      <div class="form-row col-md-6">
                        <img src="img/2.png" width="28%" class="ml-1"><h5 style="color: #fff" class="mt-2 mr-8"><?php echo $response2->id; ?> - <?php echo $response2->name; ?></h5>
                      </div> 
                    </div>
                  </div>
                    <table class="table table-hover">
                      <tbody>
                        <tr><th><?php echo $response3->genera[5]->genus; ?></th></tr>    
                      </tbody>
                    </table>
                </div>
              </div>
                 

              <div class="col-md-6">

                <div class="card">
                  <div class="card-header" style="background-color: #dc3545!important">
                        <h5 style="color: #fff" class="mt-2">Habilidades</h5>
                  </div>
                    <table class="table table-hover">
                      <tbody>
                          <?php for ($i=0; $i < count($response2->abilities); $i++) { ?>
                              <tr><th><?php echo $response2->abilities[$i]->ability->name; ?></th></tr>    
                          <?php   } ?> 
                      </tbody>
                    </table>
                </div>
                 
              </div> 
            </div>

            <br>

            <div class="form-row"> 
              <div class="col-md-6">
                <img src="<?php echo $response2->sprites->other->dream_world->front_default; ?>" width="50%">
              </div>

              <div class="col-md-6">

                <div class="card">
                  <div class="card-header" style="background-color: #dc3545!important">
                    <div class="form-row col-md-12">
                        <h5 style="color: #fff" class="mt-2">Tipo</h5>
                    </div>
                  </div>
                    <table class="table table-hover">
                      <tbody>
                          <?php for ($i=0; $i < count($response2->types); $i++) { ?>
                              <tr><th><?php echo $response2->types[$i]->type->name; ?></th></tr>    
                          <?php   } ?> 
                      </tbody>
                    </table>
                </div>
                 
              </div>
              

            </div>

            <br>

            <div class="form-row"> 
              <div class="col-md-12">

                <div class="card">
                  <div class="card-header" style="background-color: #dc3545!important">
                  </div>
                  <div class="card-body">
                     <?php for ($j=0; $j < count($response3->flavor_text_entries); $j++) { ?>
                        <?php if ($response3->flavor_text_entries[$j]->language->name=="es" && $response3->flavor_text_entries[$j]->version->name=="x"): ?>
                          <h5><?php echo $response3->flavor_text_entries[$j]->flavor_text; ?></h5>
                        <?php else: ?>
                        <?php endif ?>
                      <?php   } ?> 
                  </div>
                </div>
                 
              </div>              

            </div>
            <br>
        </div>
        <br>
      </div>

    <?php endif ?>
    <script src="libraries/app.js"></script>
  </body>
</html>
