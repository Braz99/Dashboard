$(document).ready(() => {

	$('#documentacao').on('click', () => {

		$.get('documentacao.html', data => {
			$('#pagina').html(data)
			})
	})

	$('#suporte').on('click', () => {

		$.get('suporte.html', data => {
			$('#pagina').html(data)
		})

	})


	$('#competencia').on('change', e => {

		let competencia = $(e.target).val()

		if(competencia != '') {
			$.ajax({
			type: 'GET',
			url: 'app.php',
			data: `competencia=${competencia}`,
			dataType:'json',
			success: dados => {

					if(dados.totalVendas == null) {
						dados.totalVendas = ' '}

					if(dados.totalDespesas ==null ) {
						dados.totalDespesas = ' '} 

					$('#numeroVendas').html(dados.numeroVendas)
					$('#totalVendas').html('R$ ' + dados.totalVendas.replace('.', ','))
					$('#totalDespesas').html('R$ ' + dados.totalDespesas.replace('.', ','))

					$('#clientesAtivos').html(dados.clientesAtivos)
					$('#clientesInativos').html(dados.clientesInativos)
					
					$('#totalElogios').html(dados.totalElogios)
					$('#totalSugestoes').html(dados.totalSugestoes)
					$('#totalReclamacoes').html(dados.totalReclamacoes)	

			},
			error: erro => {
				console.log(erro.responseText)}
		})
		}

	})
	
})