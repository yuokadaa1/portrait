//追加・削除のボタン押下の設定
$(function() {
	//追加
	$('.addformbox').click(function() {
		//クローンを変数に格納
		var clonecode = $('.box:last').clone(true);
		//数字を＋１し変数に格納
		var cloneno = clonecode.attr('data-formno');
		var cloneno2 = parseInt(cloneno) + 1;
    var cloneno3 = parseInt(cloneno) + 2;
		//data属性の数字を＋１
		clonecode.attr('data-formno',cloneno2);
		//数値
		clonecode.find('.no').html(cloneno3);

		//name属性の数字を+1
		var namecode = clonecode.find('input.namae').attr('name');
		namecode = namecode.replace(/input\[[0-9]{1,2}/g,'input[' + cloneno2);
		clonecode.find('input.namae').attr('name',namecode);

		var namecode2 = clonecode.find('input.toiawase').attr('name');
		namecode2 = namecode2.replace(/textarea\[[0-9]{1,2}/g,'textarea[' + cloneno2);
		clonecode.find('input.toiawase').attr('name',namecode2);

		//HTMLに追加
		clonecode.insertAfter($('.box:last'));
	});

	//削除
	$('.deletformbox').click(function() {
		//クリックされた削除ボタンの親要素を削除
		$(this).parents(".box").remove();
		var scount = 0;
		//番号振り直し
		$('.box').each(function(){
			var scount2 = scount + 1;
			//data属性の数字
			$(this).attr('data-formno',scount);
			$('.no',this).html(scount2);
			//input質問タイトル番号振り直し
			var name = $('input.namae',this).attr('name');
			name = name.replace(/input\[[0-9]{1,2}/g,'input[' + scount);
			$('input.namae',this).attr('name',name);
			//input質問タイトル番号振り直し
			var name2 = $('input.toiawase',this).attr('name');
			name2 = name2.replace(/textarea\[[0-9]{1,2}/g,'textarea[' + scount);
			$('input.toiawase',this).attr('name',name2);
			scount += 1;
		});
	});


});
