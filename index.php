
<?php /*
Template name: Главная
 */ get_header();
?>

	<div class="wrapper">

	<div tabindex="1" class="popup-rules popup">
				<div class="popup-table table">
					<div class="cell">
						<div class="popup-content popup-content__map">
							<button class="popup-close first">
								x
							</button>
							<div class="popup__title">rule</div>
							<div class="popup__content content-popup">
								<div class="content-popup__examples content-popup__item active">
							
</div>

							</div>

</div>
					</div>
				</div>
			</div>
		<main class="main shadow">
			<h1 class="main__title">learn english game - One more question</h1>
			<section class="main__screen section">
				<div class="section__inner screen office">
					<div class="screen-item__wrapper">

						<div class="game-screen active  screen-item">

							<div class="task-item item-message">


								<div class="body-task__top">
									<span class="body-task__top-message"></span>
								</div>
								<div class="body-task__content box__question box-item">
								<div class="story__wrapper">
      <div class="story__words">
		<div class="story__words-words"></div>
    
	   <a class="exclaim pl story__pl" href="#rules" ></a>
	</div>					</div>


							</div>


						</div>

					</div>


				</div>
			</section>
			<section class="main__controls section">
				<div class="controls section__inner">
					<form action="" class="form-controls">


						<div class="radio-box__wrapper">
							<div class="radio-box">
								<h3 class="radio-box__title">Level Dificulty</h3>
								<div class="radio-box__content">
									<input  class="custom-radio" tabindex="-1" id="0" name="dif" type="radio">
									<label tabindex="1" for="0" class="form-controls__usage shadow btn">basic</label>
									<input class="custom-radio" tabindex="-1" id="1" name="dif" type="radio">
									<label tabindex="1" for="1" class="form-controls__succed shadow btn">medium</label>
									<input checked class="custom-radio" tabindex="-1" id="2" name="dif" type="radio">
									<label tabindex="1" for="2" class="form-controls__usage shadow btn">advanced</label>

								</div>
							</div>
							<div class="radio-box">
								<h3 class="radio-box__title">Type of task</h3>
								<div class="radio-box__content">
									<input class="custom-radio" tabindex="-1" id="story" checked name="task"
										type="radio">
									<label tabindex="1" for="story"
										class="form-controls__usage shadow btn">story</label>
									<input class="custom-radio" tabindex="-1" id="question" name="task" type="radio">
									<label tabindex="1" for="question"
										class="form-controls__succed shadow btn">question</label>

								</div>


							</div>
							<div class="radio-box">
								<h3 class="radio-box__title">Options</h3>
								<div class="radio-box__content">
									<input checked class="custom-radio" tabindex="-1" id="grammar" name="option"
										type="checkbox">
									<label tabindex="1" for="grammar" class="form-controls__succed shadow btn">all
										grammar</label>

								</div>


							</div>
						</div>




					</form>
				</div>
			</section>
		</main>
	</div>
<?php   get_footer();?>