  <!-- ======= Contact Section ======= -->
  <section id="contact" class="section-bg bg-light">

    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>ENTRE EM CONTATO</h2>
        <p></p>
      </div>

      <div class="row contact-info">
        <!--
    <div class="col-md-4">
      <div class="contact-address">
        <i class="bi bi-geo-alt"></i>
        <h3></h3>
        <address></address>
      </div>
    </div>

    <div class="col-md-4">
      <div class="contact-phone">
        <i class="bi bi-phone"></i>
        <h3></h3>
        <p></p>
      </div>
    </div>
-->
        <div class="col-md-12">
          <div class="contact-email">
            <i class="bi bi-envelope"></i>
            <h3>Email</h3>
            <p><a href="mailto:karate@fkp.com.br">karate@fkp.com.br</a></p>
          </div>
        </div>

      </div>

      <div class="form">
        <form method="POST" action="{{ route('armazenar-newsletter') }}">
          @csrf <!-- Adicione o token CSRF para proteção contra CSRF -->

          <div class="row mb-5">
            <div class="form-group col-md-6">
              <input type="text" name="NomesDosDestinatarios" class="form-control" id="name" placeholder="Seu Nome" required>
            </div>
            <div class="form-group col-md-6 mt-3 mt-md-0">
              <input type="email" class="form-control" name="EmailsDosDestinatarios" id="email" placeholder="Seu Email" required>
            </div>
          </div>


          <button class="w-100 btn btn-danger" type="submit">ENVIAR</button>

        </form>
<!-- Seção de scripts JavaScript na sua página que contém o formulário -->
<script>
    // Verificar se há uma mensagem de sucesso na sessão
    @if(Session::has('success'))
        // Exibir o SweetAlert com a mensagem de sucesso
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '{{ Session::get('success') }}',
        });
    @endif
</script>

      </div>
    



    </div>
  </section><!-- End Contact Section -->