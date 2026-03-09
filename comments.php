<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package a-salah
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if (have_comments()) : ?>
		<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
			<?php
			$comments_number = get_comments_number();
			if ('1' === $comments_number) {
				echo 'تعليق واحد';
			} else {
				echo 'التعليقات (' . number_format_i18n($comments_number) . ')';
			}
			?>
		</h3>

		<?php
		wp_list_comments([
			'style'      => 'div',
			'short_ping' => true,
			'callback'   => 'custom_comment_output'
		]);
		?>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<nav class="flex justify-between my-6">
				<div class="text-primary"><?php previous_comments_link('التعليقات السابقة'); ?></div>
				<div class="text-primary"><?php next_comments_link('التعليقات التالية'); ?></div>
			</nav>
		<?php endif; ?>
	<?php endif; ?>

	<?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
		<p class="text-gray-700 dark:text-gray-300">التعليقات مغلقة.</p>
	<?php endif; ?>

	<?php
	comment_form([
		'title_reply'          => '<h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">أضف تعليقًا</h4>',
		'title_reply_before'   => '',
		'title_reply_after'    => '',
		'comment_notes_before' => '',
		'class_form'           => '',
		'id_form'              => 'commentform',
		'class_submit'         => 'bg-primary hover:bg-primary-dark text-white font-bold py-2 px-6 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2',
		'name_submit'          => 'submit',
		'comment_field'        => '<div class="mb-4"><label for="comment" class="block text-gray-700 dark:text-gray-300 mb-1">التعليق *</label><textarea id="comment" name="comment" rows="5" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required></textarea></div>',
		'fields'               => [
			'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4"><div><label for="author" class="block text-gray-700 dark:text-gray-300 mb-1">الاسم *</label><input type="text" id="author" name="author" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required /></div>',
			'email'  => '<div><label for="email" class="block text-gray-700 dark:text-gray-300 mb-1">البريد الإلكتروني *</label><input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-primary focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white" required /></div></div>',
			'cookies' => '<div class="mb-4"><label class="flex items-center"><input type="checkbox" name="wp-comment-cookies-consent" id="wp-comment-cookies-consent" value="yes" class="ml-2" /><span class="text-gray-700 dark:text-gray-300 text-sm">احفظ اسمي والبريد الإلكتروني في هذا المتصفح للمرة القادمة</span></label></div>',
		],
		'comment_notes_after' => '',
		'submit_button'       => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
		'submit_field'        => '<p class="form-submit">%1$s %2$s</p>',
	]);
	?>
</div>

<?php
/**
 * Custom comment output function
 */
function custom_comment_output($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;

	$is_last = ($depth >= $args['max_depth']);
?>

	<div id="comment-<?php comment_ID(); ?>" class="mb-8 border-b border-gray-200 dark:border-gray-700 pb-8 <?php echo $is_last ? 'last:border-0 last:pb-0' : ''; ?>">
		<div class="flex items-start">
			<?php
			echo get_avatar($comment, 40, '', '', [
				'class' => 'w-10 h-10 rounded-full ml-4 object-cover'
			]);
			?>
			<div>
				<div class="flex items-center mb-2">
					<h4 class="font-bold text-gray-900 dark:text-white ml-2"><?php comment_author(); ?></h4>
					<span class="text-sm text-gray-600 dark:text-gray-400"><?php echo get_comment_date(); ?></span>
				</div>
				<div class="text-gray-700 dark:text-gray-300"><?php comment_text(); ?></div>

				<?php if (isset($args['comments_open']) && 'open' == $args['comments_open']) : ?>
					<div class="reply mt-2">
						<?php
						comment_reply_link(array_merge($args, [
							'depth' => $depth,
							'max_depth' => $args['max_depth'],
							'reply_text' => 'الرد',
							'add_below' => 'comment',
							'before' => '',
							'after' => '',
							'class' => 'text-primary hover:text-primary-dark focus:outline-none text-sm font-medium'
						]));
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php
}
?>