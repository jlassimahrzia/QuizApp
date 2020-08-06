@extends('layouts.app')
@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/jquery.dataTables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/datatables/media/css/responsive.dataTables.css')}}">
<style>
    h1 {
        font-family: "Comic Sans MS", cursive, sans-serif;
    }
</style>

@endsection

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h1><b>Liste des Enseignants</b></h1>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Enseignant</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Consulter</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div class="dropdown">

                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Export List</a>
                    <a class="dropdown-item" href="#">Policies</a>
                    <a class="dropdown-item" href="#">View Assets</a>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="row">
        <table class="stripe hover multiple-select-row data-table-export nowrap">
            <thead>
                <tr>
                    <th>Nom de famille</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Mettre A jour</th>
                    <th> Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
           /*  while($row=mysqli_fetch_array($res)){
                 echo"<tr class='table-plus' ".$row[0].">";
                 echo"<td class='table-plus' >".$row[0]."</td>";
                 echo"<td  class='table-plus'>".$row[1]."</td>";
                 echo"<td  class='table-plus' >".$row[2]."</td>";
                 echo"<td   class='table-plus'>".$row[3]."</td>";
                 echo"<td   class='table-plus'>".$row[4]."</td>";
				 echo"<td  class='table-plus'>".$row[5]."</td>";

echo'<td class="table-plus"><a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" href="modifier_enseignant.php?id=' . $row['cin_ens'] . '"><i class="icon-copy fi-page-edit"></i>  Mettre A jour</a></td>';
echo'<td class="table-plus"><button class="btn btn-danger" onclick ="supp_ens(&#39;'.$row[0].'&#39;)"><i class="icon-copy fa fa-user-times" aria-hidden="true"></i> Supprimer </button></td>
<td> <button class="btn btn-success" onclick="info_sms(&#39;'.$row[0].'&#39;,&#39;'.$row[3].'&#39;,&#39;'.$row[5].'&#39;)"><i class="icon-copy fa fa-envelope-open" aria-hidden="true"></i> Informer </button> </td></tr>';
             }*/

             ?>
            </tbody>
        </table>
    </div>
</div>
    @section('script')
    <script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts.js')}}"></script>
    <script src="{{asset('src/plugins/highcharts-6.0.7/code/highcharts-more.js')}}"></script>


    <script src="{{asset('src/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/dataTables.responsive.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/responsive.bootstrap4.js')}}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{asset('src/plugins/datatables/media/js/button/dataTables.buttons.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.bootstrap4.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.print.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.html5.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/buttons.flash.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/pdfmake.min.js')}}"></script>
    <script src="{{asset('src/plugins/datatables/media/js/button/vfs_fonts.js')}}"></script>
    <script>
        $('document').ready(function(){
			$('.data-table').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
			});
			$('.data-table-export').DataTable({
				scrollCollapse: true,
				autoWidth: false,
				responsive: true,
				columnDefs: [{
					targets: "datatable-nosort",
					orderable: false,
				}],
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"language": {
					"info": "_START_-_END_ of _TOTAL_ entries",
					searchPlaceholder: "Search"
				},
				dom: 'Bfrtip',
				buttons: [
				'copy', 'csv', 'pdf', 'print'
				]
			});
			var table = $('.select-row').DataTable();
			$('.select-row tbody').on('click', 'tr', function () {
				if ($(this).hasClass('selected')) {
					$(this).removeClass('selected');
				}
				else {
					table.$('tr.selected').removeClass('selected');
					$(this).addClass('selected');
				}
			});
			var multipletable = $('.multiple-select-row').DataTable();
			$('.multiple-select-row tbody').on('click', 'tr', function () {
				$(this).toggleClass('selected');
			});
		});
    </script>



    <script src="{{asset('src1/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('src1/plugins/sweetalert2/sweetalert2.css')}}">
    <script src="{{asset('src1/plugins/sweetalert2/sweet-alert.init.js')}}"></script>
    <script>
        /*	function supp_ens($cin_ens){

		swal({
			title: "Vous êtes sûr ?",
      text: "Enseignant sera supprimé d'une façon permanente !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
.then((willDelete) => {
  if (willDelete) {
		window.location.href = "supprimer_enseignant.php?cin_ens="+$cin_ens;
  } else {
    swal("Suppression Annulée");
  }
});


    }*/
    </script>
@endsection
@endsection
