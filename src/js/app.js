$(document).ready(function() {
    $('#reverseForm').on('submit', function(e) {
        e.preventDefault();
        var input = $('#input').val();
        if (!input.trim()) return;

        $('#loading').removeClass('hidden');
        setTimeout(() => {
            $('#loading').addClass('show');
        }, 10);

        $('#result').addClass('hidden');

        $.ajax({
            url: '/',
            type: 'POST',
            data: { input: input },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            dataType: 'json',
            success: function(data) {
                $('#output').text(data.output);

                $('#loading').removeClass('show');
                setTimeout(() => {
                    $('#loading').addClass('hidden');
                    $('#result').removeClass('hidden');
                }, 300);
            },
            error: function() {
                console.error('Error');
                $('#output').text('Возникла ошибка, попробуйте снова');

                $('#loading').removeClass('show');
                setTimeout(() => {
                    $('#loading').addClass('hidden');
                    $('#result').removeClass('hidden');
                }, 300);
            }
        });
    });
});