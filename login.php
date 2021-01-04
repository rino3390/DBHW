<!--登入頁面-->
<section id="cover" class="min-vh-100 main-content">
	<div id="cover-caption">
		<div class="container">
			<div class="row text-white">
				<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
					<h1 class="display-4 py-2 text-truncate">系統登入</h1>
					<div class="px-2">
						<form id="login" name="login" action="index.php" method="post" onsubmit="return checkNull()" class="justify-content-center">
							<div class="form-group row">
								<label class="col-sm-2 control-label">帳號</label>
								<div class="col-sm-10">
									<input id="account" name="account" type="text" class="form-control">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 control-label" for="pwd">密碼</label>
								<div class="col-sm-10">
									<input id="pwd" name="pwd" type="password" class="form-control">
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-lg">登入</button>
						</form>
						<?php if ((isset($_GET['failed']) && $_GET['failed'] == 1)) echo "<text style=\"color:red;font-size:15px;\">帳號密碼錯誤。</text>"; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>