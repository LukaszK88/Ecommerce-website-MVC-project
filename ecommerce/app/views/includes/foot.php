<!-- jQuery -->
<script src="<?php echo Url::path()?>/js/jquery.js"></script>
<script src="https://js.braintreegateway.com/js/braintree-2.29.0.min.js"></script>
<script>
    $.ajax({
        url:'<?php echo Url::path()?>/braintree/index',
        type: 'get',
        dataType: 'json'
    }).success(function (data) {
        braintree.setup(data.token, 'dropin',{
            container: 'payment'
        });
    });
</script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo Url::path()?>/js/bootstrap-slider.min.js"></script>
<script src="<?php echo Url::path()?>/js/bootstrap-slider.js"></script>
<script src="<?php echo Url::path()?>/js/bootstrap.min.js"></script>
<script>$('.ex1').slider({
        formatter: function(value) {
            return 'Current value: ' + value;
        }
    });</script>
<script>
    $(document).ready(function(){
        $('.dropdown-submenu a.test').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
        });
    });
</script>


</body>

</html>