
<!-- Page Heading -->
<header class="bg-white mb-4" id="title">
    <div class="mx-auto py-4">
        <h5 class="font-semibold text-gray-800 pl-5">
            JSON
        </h5>
    </div>
</header>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card mb-3">
        <div class="card-body">
            <pre id="result"></pre>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>    
    $(document).ready(function(){
        $.ajax({
            url: "<?= base_url('json/fetch_data'); ?>",
            type:'POST',
            dataType: 'JSON',
            success: function(response) {
                var obj = JSON.stringify(response, undefined, 2);
                $('#result').text(obj);
            }
        });
    });
</script>