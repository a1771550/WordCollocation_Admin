/**
 * Created by kevinlau on 10/6/16.
 */
$('document').ready(function ()
{

	if ($('button#btnIndex').length)
	{
		$('button#btnIndex').click(function (e)
		{
			e.preventDefault();
			window.location.assign('index');
		});
	}

	if ($('p.more').length)
	{
		var enableShowMore = $('#enableShowMore').val();
		if (enableShowMore === 'true')
		{
			var showChar = $('#showCharNum').val();  // How many characters are shown by default
			var ellipsestext = "...";
			var moretext = $('#showMoreText').val();
			var lesstext = $('#showLessText').val();

			$('p.more').each(function ()
			{
				var content = $(this).html();

				if (content.length > showChar)
				{

					var c = content.substr(0, showChar);
					var h = content.substr(showChar, content.length - showChar);

					var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

					$(this).html(html);
				}

			});

			$(".morelink").click(function ()
			{
				if ($(this).hasClass("less"))
				{
					$(this).removeClass("less");
					$(this).html(moretext);
				} else
				{
					$(this).addClass("less");
					$(this).html(lesstext);
				}
				$(this).parent().prev().toggle();
				$(this).prev().toggle();
				return false;
			});
		}
	}
});