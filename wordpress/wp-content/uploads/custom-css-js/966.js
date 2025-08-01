<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
 

document.addEventListener('DOMContentLoaded', function() {
    var hoverElement = document.querySelector('a.has-submenu');
    var targetElement = document.querySelector('ul.submenu');

    if (hoverElement && targetElement) {
        hoverElement.addEventListener('mouseover', function() {
            targetElement.style.display = 'flex';
            targetElement.style.flexDirection = 'row';
            targetElement.style.justifyContent = 'space-evenly';
            targetElement.style.alignItems = 'center';
        });

        hoverElement.addEventListener('mouseout', function() {
            targetElement.style.display = '';
            targetElement.style.flexDirection = '';
            targetElement.style.justifyContent = '';
            targetElement.style.alignItems = '';
        });
    }
});
</script>
<!-- end Simple Custom CSS and JS -->
