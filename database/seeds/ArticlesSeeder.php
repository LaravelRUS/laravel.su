<?php

/**
 * This file is part of laravel.su package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * @param Connection $conn
     */
    public function __construct(
        private readonly Connection $conn
    ) {
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->conn->table('articles')
            ->insert([
                'title'            => 'Как правильно переводить документацию Laravel',
                'urn'              => 'rus-documentation-contribution-guide',
                'description'      => 'Хотите помочь с переводом документации ? Отлично ! Вот инструкции, как это сделать правильно.',
                'content_source'   => "Оригинал англоязычной документации находится по адресу [https://github.com/laravel/docs](https://github.com/laravel/docs).\n\nПеревод документации на русский находится на гитхабе по адресу [https://github.com/LaravelRUS/docs](https://github.com/LaravelRUS/docs) . Апдейт перевода осуществляется пулл-реквестами в этот репозиторий.\n\nРедактирование репозитория с переводом может происходить в двух вариантах - внесение незначительных изменений и обновление перевода файла до актуального.\n\n### Внесение мелких изменений\n\nЕсли вы заметили опечатку, некрасивый перевод, неподходящее употребление термина - вы можете просто отредактировать файл прямо на гитхабе. Не нужно уметь пользоваться git , гитхаб сам сделает пулл-реквест.\nЕсли же вы заметили, что в русской документации отсутствует фича, которая есть в документации англоязычной, вам нужно использовать другой вариант работы.\n\n### Обновление перевода до актуального\n\n#### Формат файла перевода\n\nФайлы русскоязычной документации имеют определенный формат. В начале каждого файла должна быть конструкция следующего вида (обратите внимание, что в середине - пустая строка):\n```\ngit a49894e56c3ac8b837ba7d8687d94f6010cb1808\n\n---\n```\nгде `a49894e56c3ac8b837ba7d8687d94f6010cb1808` - полный номер коммита в англоязычной документации, последнего актуального на момент редактирования для данного файла. Это нужно для того, чтобы понимать, что именно переведено, а что еще нет - чтобы следующий переводчик не просматривал глазами весь файл в поисках изменений, а просто внес то, что ему покажет `git diff`\n\nИтак, последовательность действий при переводе документации следующая.\n\n#### Настройка git difftool\n\nЕсли вы этого не сделали, установите себе инструмент для визуального сравнения разных версий текста. Их существует огромное множество, кросплатформенный бесплатный вариант - KDiff3 [http://sourceforge.net/projects/kdiff3/](http://sourceforge.net/projects/kdiff3/)\n\nПосле установки, отредактируйте глобальный файл `.gitconfig` , который находится в папке пользователя (для Windows это `C:\\Users\\(username)`) . Добавьте туда следующие строки:\n\n```\n[diff]\n    tool = kdiff3\n\n[merge]\n    tool = kdiff3\n\n[mergetool \"kdiff3\"]\n    path = C:/Program Files/KDiff3/kdiff3.exe\n    keepBackup = false\n    trustExitCode = false\n```\nгде path - это путь до исполняемого файла kdiff3.\n\nЕсли у вас стоит другая diff-программа, например Araxis Merge или DiffMerge, то погуглите, как её настроить для гита - \'(program name) difftool gitconfig\'\n\n#### Получение текста для перевода\n\nСклонируйте репозиторий оригинальной документации\n```\ngit clone https://github.com/laravel/docs.git original_docs\ncd original_docs\ngit checkout master\n```\nили, если он уже у вас есть, обновите нужную вам ветку \n```\noriginal_docs> git checkout master\noriginal_docs> git reset HEAD --hard\noriginal_docs> git pull origin master\n```\n\nНа странице [Прогресс перевода](http://laravel.su/status) посмотрите, какой файл нуждается в переводе и скопируйте соответствующую команду `git difftool xxxxxxx xxxxxxx file.md` , чтобы узнать, что именно нужно переводить\n```\noriginal_docs> git difftool a06af42 bc291ef controllers.md\n```\nGit захочет запустить внешнюю diff-программу, настроенную на предыдущем шаге, соглашайтесь.\n\nВ появившейся программе справа будет старый файл, а слева - новый, цветом отмечены расхождения в версиях. \n\nВнесите необходимые изменения в файл перевода. Изменения нужно внести **все** ,чтобы переведенный файл полностью соответствовал оригинальному. Нельзя останавливаться на середине и пушить изменения - следующий человек может подумать, что файл уже переведён полностью.\n\n#### Финальные шаги\n\n**Обязательно** измените в начале переводимого файла полный номер коммита. Этот номер можно взять на той же странице [прогресса перевода](http://laravel.su/docs/status) в столбце \"Текущий оригинал\".\n\nЗакоммитьте изменения и пошлите пулл-реквест из гитхаба. Старайтесь делать изменение только одного файла во время одного коммита.",
                'content_rendered' => '',
                'author_id'        => 1,
                'published_at'     => '2019-12-27 07:47:00',
                'created_at'       => '2019-12-27 07:47:03',
                'updated_at'       => '2019-12-27 07:47:07',
            ])
        ;
    }
}
