<?php

/* a translation function i can call this function anywhere required only key and hi give me the correct value  */
function trans($key)
{
    $lang = array(
        'ar' => [],
        'en' => [],
        'fr' => [],
    );

    $lang['en'] = [
        'candidat.actions' => 'actions',
        'candidat.alert-message' => 'alert message!',
        'candidat.all-field-required' => 'all field required!',
        'candidat.are-you-sure-you-went-delete-that' => 'are you sure you went to delete that!',
        'candidat.candidat-already-exists' => 'Candidat already exists',
        'candidat.candidat-not-found' => 'candidat not found!',
        'candidat.class' => 'class',
        'candidat.class-name' => 'class name',
        'candidat.close' => 'close',
        'candidat.could-not-create-class-candidat' => 'could not create class candidat',
        'candidat.could-not-create-this-candidat' => 'could not create this candidat',
        'candidat.could-not-update-class-candidat' => 'could not update class candidat',
        'candidat.could-not-update-information-candidat' => 'could not update information candidat',
        'candidat.create' => 'create',
        'candidat.create-candidat' => 'create candidat',
        'candidat.create-candidat-dialog' => 'create candidat dialog!',
        'candidat.create-candidat-success' => 'create candidat success',
        'candidat.delete' => 'delete',
        'candidat.delete-candidat-success' => 'delete candidat success!',
        'candidat.edit' => 'edit',
        'candidat.email' => 'email',
        'candidat.email-already-exists-for-other-candidat' => 'email already exists for other candidat!',
        'candidat.email-already-exists-for-this-class' => 'email already exists for this class!',
        'candidat.email-must-be-valide' => 'email must be valide',
        'candidat.file-name' => 'file name',
        'candidat.file-not-exists' => 'file not exists',
        'candidat.filter' => 'filter',
        'candidat.filter-candidat' => 'filter candidat',
        'candidat.filter-candidat-dialog' => 'filter candidat dialog',
        'candidat.first-name' => 'first name',
        'candidat.id' => 'id',
        'candidat.id-candidat' => 'id candidat',
        'candidat.id-classe' => 'id classe',
        'candidat.id-classe-is-not-array-given' => 'id classe is not array given',
        'candidat.import' => 'import',
        'candidat.import-candidat' => 'impport candidat dialog',
        'candidat.import-candidat-dialog' => 'import candidat dialog',
        'candidat.import-candidat-success' => 'import candidat success',
        'candidat.last-name' => 'last name',
        'candidat.list-candidates' => 'candidat list',
        'candidat.must-be-valide' => 'must be valide',
        'candidat.no-cancel' => 'no; cancel!',
        'candidat.required' => 'required',
        'candidat.reset' => 'reset',
        'candidat.update-candidat' => 'update candidat',
        'candidat.update-candidat-dialog' => 'update candidat dialog!',
        'candidat.update-candidat-success' => 'update candidat success!',
        'candidat.verify' => 'verify',
        'candidat.verify-id-classe' => 'should verify id classe!',
        'candidat.wait-candidat-creating' => 'wait candidat creating!',
        'candidat.wait-candidat-upadting' => 'wait candidat upadting',
        'candidat.wait-data-candidat-loading' => 'wait data candidat for loading!',
        'candidat.year' => 'year',
        'candidat.yes-delete-it' => 'yes; delete it!',
        'classe.actions' => 'actions',
        'classe.alert-message' => 'alert message!',
        'classe.all-field-required' => 'all field required!',
        'classe.are-you-sure-you-went-delete-that' => 'are you sure you went delete that!',
        'classe.avg-note' => 'average note',
        'classe.classe-not-found' => 'classe not found',
        'classe.close' => 'close',
        'classe.code' => 'code',
        'classe.code-already-exists' => 'code of this classe already exists',
        'classe.could-not-create-this-classe' => 'could not create this classe',
        'classe.could-not-update-this-classe' => 'could not update this classe',
        'classe.create' => 'create',
        'classe.create-classe' => 'create classe',
        'classe.create-classe-dialog' => 'create classe dialog',
        'classe.create-classe-success' => 'classe created success',
        'classe.delete' => 'delete',
        'classe.delete-classe-success' => 'classe deleted success',
        'classe.edit' => 'edit',
        'classe.id' => 'id',
        'classe.import-candidat' => 'import candidat',
        'classe.list-classes' => 'list classes',
        'classe.name' => 'name',
        'classe.no-cancel' => 'no; cancel!',
        'classe.top-1' => 'top 1',
        'classe.total-candidat' => 'total candidat',
        'classe.update-classe' => 'update classe',
        'classe.update-classe-dialog' => 'update classe dialog',
        'classe.update-classe-success' => 'classe updated success',
        'classe.wait-classe-creating' => 'wait classe creating...',
        'classe.wait-classe-upadting' => 'wait classe updating...',
        'classe.wait-data-classe-loading' => 'wait classe data loading',
        'classe.year' => 'year',
        'classe.year-is-not-number' => 'year is not number',
        'classe.yes-delete-it' => 'yes; delete it!',
        'course.actions' => 'actions',
        'course.add-question' => 'add question',
        'course.alert-message' => 'alert message!',
        'course.all-field-required' => 'all field required!',
        'course.are-you-sure-you-went-delete-that' => 'are you sure you went delete that!',
        'course.change-question-course-success' => 'change question course success',
        'course.close' => 'close',
        'course.could-not-create-this-course' => 'could not create this course',
        'course.could-not-create-this-question' => 'could not create this question',
        'course.could-not-update-this-course' => 'could not update this course',
        'course.could-not-update-this-question' => 'could not update this question',
        'course.course-not-found' => 'course not found',
        'course.create' => 'create',
        'course.create-course' => 'create course',
        'course.create-course-dialog' => 'create course dialog',
        'course.create-course-success' => 'course created success',
        'course.create-exam' => 'create exam',
        'course.create-question' => 'create question',
        'course.delete' => 'delete',
        'course.delete-course-success' => 'course deleted success',
        'course.edit' => 'edit',
        'course.id' => 'id',
        'course.last-started-exam' => 'last started exam',
        'course.list-courses' => 'list courses',
        'course.name' => 'name',
        'course.name-field-required' => 'name field required!',
        'course.no-cancel' => 'no; cancel!',
        'course.number-question' => 'number questions',
        'course.question-add-option' => 'add option',
        'course.question-course-dialog' => 'question course dialog',
        'course.question.delete' => 'question delete',
        'course.question.false' => 'false',
        'course.question.options' => 'options',
        'course.question.title' => 'title',
        'course.question.true' => 'true',
        'course.question.type' => 'type',
        'course.save-changes' => 'save changes',
        'course.update-course' => 'update course',
        'course.update-course-dialog' => 'update course dialog',
        'course.update-course-success' => 'course updated success',
        'course.wait-course-creating' => 'wait course creating...',
        'course.wait-course-upadting' => 'wait course upadting...',
        'course.wait-data-course-loading' => 'wait course data loading',
        'course.yes-delete-it' => 'yes; delete it!',
        'exam-candidat.already-closed' => 'exam candidat already closed',
        'exam-candidat.not-authorized-to-close-this-exam' => 'not authorized to close this exam',
        'exam-candidat.not-found' => 'exam candidat not found',
        'exam-candidat.not-started-for-closed' => 'exam candidat not started for closed',
        'exam.actions' => 'actions',
        'exam.alert-message' => 'alert message',
        'exam.all-field-required' => 'all field required',
        'exam.are-you-sure-you-went-delete-that' => 'are you sure you went to delete that!',
        'exam.catch-up' => 'catch up',
        'exam.change-order' => 'change order',
        'exam.choices' => 'choices',
        'exam.class-not-found' => 'class not found',
        'exam.classes' => 'classes',
        'exam.close' => 'close',
        'exam.closing' => 'closing',
        'exam.could-not-create-this-exam' => 'could not create this exam',
        'exam.could-not-update-this-exam' => 'could not update this exam',
        'exam.cours' => 'course',
        'exam.course-not-found' => 'course not found',
        'exam.create' => 'create',
        'exam.create-exam' => 'create exam',
        'exam.create-exam-dialog' => 'exam dialog',
        'exam.create-exam-success' => 'create exam success',
        'exam.delete' => 'delete',
        'exam.delete-exam-success' => 'delete exam success',
        'exam.document-type-not-supported' => 'document type not supported',
        'exam.duration' => 'duration',
        'exam.dureation-min' => 'duration (min)',
        'exam.edit' => 'edit',
        'exam.exam-not-found' => 'exam not found',
        'exam.export.html' => 'export html',
        'exam.export.pdf' => 'export pdf',
        'exam.export.word' => 'export word',
        'exam.field-required' => 'filed required',
        'exam.info' => 'info',
        'exam.list-exams' => 'list exams',
        'exam.message-send-success' => 'message send success',
        'exam.mark' => 'Mark',
        'exam.marks' => 'Marks',
        'exam.mark-exam-dialog' => 'Mark Exam Dialog',
        'exam.export.excel' => 'Export Excel',
        'exam.nature' => 'nature',
        'exam.no-cancel' => 'no cancel',
        'exam.normal' => 'normal',
        'exam.number-version' => 'number version',
        'exam.offline' => 'offline',
        'exam.online' => 'online',
        'exam.opened' => 'opened',
        'exam.question-changes' => 'question changes',
        'exam.question-exam-dialog' => 'question exam dialog',
        'exam.questions' => 'questions',
        'exam.send-exam-via-email' => 'send exam via email',
        'exam.start-in' => 'start in',
        'exam.status' => 'status',
        'exam.strict-date' => 'strict date',
        'exam.type' => 'type',
        'exam.update-exam' => 'update exam',
        'exam.update-exam-dialog' => 'update exam dialog',
        'exam.update-exam-success' => 'update exam success',
        'exam.versions' => 'versions',
        'exam.view-marks' => 'view marks',
        'exam.view-question' => 'view question',
        'exam.wait-data-exam-loading' => 'wait data exam loading',
        'exam.wait-exam-creating' => 'wait exam creating',
        'exam.wait-exam-upadting' => 'wait exam upadting',
        'exam.yes-delete-it' => 'yes delete it!',
        'header.search-here' => 'search here...',
        'menu.calendar' => 'calendar',
        'menu.candidates' => 'candidates',
        'menu.classes' => 'classes',
        'menu.classes-management' => 'classes management',
        'menu.courses' => 'courses',
        'menu.courses-management' => 'courses management',
        'menu.dashboard' => 'dashboard',
        'menu.exams' => 'exams',
        'menu.exams-management' => 'exams management',
        'menu.main' => 'main',
        'candidat.the-format-of-id-classe-should-be-array' => 'the format of id classe should be array!',
        'candidat.wait-candidat-updating' => 'wait candidat updating!',
        'classe.last-started-exam' => 'last started exam',
        'classe.name-field-required' => 'name field required!',
        'classe.number-question' => 'number questions',
        'classe.wait-classe-updating' => 'wait classe updating...',
        'course.wait-course-updating' => 'wait course updating...',
    ];

    $lang['fr'] = [
        'candidat.actions' => 'actions',
        'candidat.alert-message' => 'message d\'alerte !',
        'candidat.all-field-required' => 'tous les champs sont obligatoires !',
        'candidat.are-you-sure-you-went-delete-that' => 'êtes-vous sûr de vouloir supprimer ça!',
        'candidat.candidat-already-exists' => 'Candidat deja existe',
        'candidat.candidat-not-found' => 'candidat introuvable !',
        'candidat.class' => 'classe',
        'candidat.class-name' => 'nom de la classe',
        'candidat.close' => 'fermer',
        'candidat.could-not-create-class-candidat' => 'impossible de créer la classe candidate',
        'candidat.could-not-create-this-candidat' => 'impossible de créer ce candidat',
        'candidat.could-not-update-class-candidat' => 'impossible de mettre à jour le candidat de la classe',
        'candidat.could-not-update-information-candidat' => 'impossible de mettre à jour les informations du candidat',
        'candidat.create' => 'créer',
        'candidat.create-candidat' => 'créer un candidat',
        'candidat.create-candidat-dialog' => 'créer une boîte de dialogue candidat!',
        'candidat.create-candidat-success' => 'création du candidat réussie',
        'candidat.delete' => 'supprimer',
        'candidat.delete-candidat-success' => 'suppression du candidat réussie !',
        'candidat.edit' => 'modifier',
        'candidat.email' => 'e-mail',
        'candidat.email-already-exists-for-other-candidat' => 'l\'email existe déjà pour un autre candidat !',
        'candidat.email-already-exists-for-this-class' => 'l\'email existe déjà pour cette classe !',
        'candidat.email-must-be-valide' => 'l\'email doit être valide',
        'candidat.file-name' => 'nom du fichier',
        'candidat.file-not-exists' => 'le fichier n\'existe pas',
        'candidat.filter' => 'filtrer',
        'candidat.filter-candidat' => 'filtrer les candidats',
        'candidat.filter-candidat-dialog' => 'filtrer la boîte de dialogue des candidats',
        'candidat.first-name' => 'prénom',
        'candidat.id' => 'id',
        'candidat.id-candidat' => 'identifiant candidat',
        'candidat.id-classe' => 'classe d\'identifiant',
        'candidat.id-classe-is-not-array-given' => 'la classe d\'id n\'est pas un tableau donné',
        'candidat.import' => 'importer',
        'candidat.import-candidat' => 'importer la boîte de dialogue du candidat',
        'candidat.import-candidat-dialog' => 'importer la boîte de dialogue des candidats',
        'candidat.import-candidat-success' => 'importer le candidat réussi',
        'candidat.last-name' => 'nom de famille',
        'candidat.list-candidates' => 'liste des candidats',
        'candidat.must-be-valide' => 'doit être valide',
        'candidat.no-cancel' => 'non ; annuler!',
        'candidat.required' => 'requis',
        'candidat.reset' => 'réinitialiser',
        'candidat.update-candidat' => 'mettre à jour le candidat',
        'candidat.update-candidat-dialog' => 'mettre à jour la boîte de dialogue du candidat !',
        'candidat.update-candidat-success' => 'mettre à jour le candidat réussi !',
        'candidat.verify' => 'vérifier',
        'candidat.verify-id-classe' => ' vérification de la classe id !',
        'candidat.wait-candidat-creating' => 'attendre la création du candidat !',
        'candidat.wait-candidat-upadting' => 'attendre la mise à jour du candidat',
        'candidat.wait-data-candidat-loading' => 'attendre le chargement des données candidates !',
        'candidat.year' => 'année',
        'candidat.yes-delete-it' => 'oui ; supprime-le!',
        'classe.actions' => 'actions',
        'classe.alert-message' => 'message d\'alerte !',
        'classe.all-field-required' => 'tous les champs sont obligatoires !',
        'classe.are-you-sure-you-went-delete-that' => 'êtes-vous sûr d\'avoir supprimer ça!',
        'classe.avg-note' => 'note moyenne',
        'classe.classe-not-found' => 'classe introuvable',
        'classe.close' => 'fermer',
        'classe.code' => 'code',
        'classe.code-already-exists' => 'le code de cette classe existe déjà',
        'classe.could-not-create-this-classe' => 'impossible de créer cette classe',
        'classe.could-not-update-this-classe' => 'impossible de mettre à jour cette classe',
        'classe.create' => 'créer',
        'classe.create-classe' => 'créer une classe',
        'classe.create-classe-dialog' => 'créer une boîte de dialogue de la classe',
        'classe.create-classe-success' => 'classe créée avec succès',
        'classe.delete' => 'supprimer',
        'classe.delete-classe-success' => 'suppression de la classe réussie',
        'classe.edit' => 'modifier',
        'classe.id' => 'id',
        'classe.import-candidat' => 'importer un candidat',
        'classe.list-classes' => 'liste des classes',
        'classe.name' => 'nom',
        'classe.no-cancel' => 'non ; annuler!',
        'classe.top-1' => 'top 1',
        'classe.total-candidat' => 'candidat total',
        'classe.update-classe' => 'mettre à jour la classe',
        'classe.update-classe-dialog' => 'mettre à jour la boîte de dialogue de la classe',
        'classe.update-classe-success' => 'la classe a été mise à jour avec succès',
        'classe.wait-classe-creating' => 'attendre la création de la classe...',
        'classe.wait-classe-upadting' => 'attendre la mise à jour de la classe...',
        'classe.wait-data-classe-loading' => 'attendre le chargement des données de la classe',
        'classe.année' => 'année',
        'classe.année-est-not-number' => 'l\'année n\'est pas un nombre',
        'classe.yes-delete-it' => 'oui ; supprime-le!',
        'course.actions' => 'actions',
        'course.add-question' => 'ajouter une question',
        'course.alert-message' => 'message d\'alerte !',
        'course.all-field-required' => 'tous les champs sont obligatoires !',
        'course.are-you-sure-you-went-delete-that' => 'êtes-vous sûr d\'avoir supprimé ça!',
        'course.change-question-course-success' => 'réussite du cours changer de question',
        'course.close' => 'fermer',
        'course.could-not-create-this-course' => 'impossible de créer ce cours',
        'course.could-not-create-this-question' => 'impossible de créer cette question',
        'course.could-not-update-this-course' => 'impossible de mettre à jour ce cours',
        'course.could-not-update-this-question' => 'impossible de mettre à jour cette question',
        'course.course-not-found' => 'cours introuvable',
        'course.create' => 'créer',
        'course.create-course' => 'créer un cours',
        'course.create-course-dialog' => 'créer une boîte de dialogue de cours',
        'course.create-course-success' => 'cours créé avec succès',
        'course.create-exam' => 'créer un examen',
        'course.create-question' => 'créer une question',
        'course.delete' => 'supprimer',
        'course.delete-course-success' => 'cours supprimé avec succès',
        'course.edit' => 'modifier',
        'course.id' => 'id',
        'course.last-started-exam' => 'dernier examen a été commencé',
        'course.list-courses' => 'liste des cours',
        'course.name' => 'nom',
        'course.name-field-required' => 'champ de nom obligatoire !',
        'course.no-cancel' => 'non ; annuler!',
        'course.number-question' => 'questions sur les nombres',
        'course.question-add-option' => 'ajouter une option',
        'course.question-course-dialog' => 'boîte de dialogue des questions sur le cours',
        'course.question.delete' => 'supprimer la question',
        'course.question.false' => 'faux',
        'course.question.options' => 'options',
        'course.question.title' => 'titre',
        'course.question.true' => 'vrai',
        'course.question.type' => 'type',
        'course.save-changes' => 'enregistrer les modifications',
        'course.update-course' => 'mettre à jour le cours',
        'course.update-course-dialog' => 'mettre à jour la boîte de dialogue du cours',
        'course.update-course-success' => 'cours mis à jour avec succès',
        'course.wait-course-creating' => 'attendre la création du cours...',
        'course.wait-course-upadting' => 'attendre la mise à jour du cours...',
        'course.wait-data-course-loading' => 'attendre le chargement des données du cours',
        'course.yes-delete-it' => 'oui ; supprime-le!',
        'exam-candidat.already-closed' => 'candidat examen déjà fermé',
        'exam-candidat.not-authorized-to-close-this-exam' => 'non autorisé à clôturer cet examen',
        'exam-candidat.not-found' => 'candidat examen introuvable',
        'exam-candidat.not-started-for-closed' => 'candidat examen non commencé car fermé',
        'exam.actions' => 'actions',
        'exam.alert-message' => 'message d\'alerte',
        'exam.all-field-required' => 'tous les champs sont requis',
        'exam.are-you-sure-you-went-delete-that' => 'êtes-vous sûr d\'être allé supprimer ça!',
        'exam.catch-up' => 'rattraper',
        'exam.change-order' => 'modifier l\'ordre',
        'exam.choices' => 'choix',
        'exam.class-not-found' => 'classe introuvable',
        'exam.classes' => 'cours',
        'exam.close' => 'fermer',
        'exam.closing' => 'fermeture',
        'exam.could-not-create-this-exam' => 'impossible de créer cet examen',
        'exam.could-not-update-this-exam' => 'impossible de mettre à jour cet examen',
        'exam.cours' => 'cours',
        'exam.course-not-found' => 'cours introuvable',
        'exam.create' => 'créer',
        'exam.create-exam' => 'créer un examen',
        'exam.create-exam-dialog' => 'dialogue d\'examen',
        'exam.create-exam-success' => 'création d\'examen réussie',
        'exam.delete' => 'supprimer',
        'exam.delete-exam-success' => 'supprimer la réussite à l\'examen',
        'exam.document-type-not-supported' => 'type de document non pris en charge',
        'exam.duration' => 'durée',
        'exam.dureation-min' => 'durée (min)',
        'exam.edit' => 'modifier',
        'exam.exam-not-found' => 'examen introuvable',
        'exam.export.html' => 'exporter html',
        'exam.export.pdf' => 'exporter le pdf',
        'exam.export.word' => 'exporter le mot',
        'exam.field-required' => 'fichier requis',
        'exam.info' => 'infos',
        'exam.list-exams' => 'liste des examens',
        'exam.message-send-success' => 'message envoyé avec succès',
        'exam.mark' => 'note',
        'exam.marks' => 'Marks',
        'exam.mark-exam-dialog' => 'note d\'examen Dialogue',
        'exam.export.excel' => 'Exporter Excel',
        'exam.nature' => 'nature',
        'exam.no-cancel' => 'pas d\'annulation',
        'examen.normal' => 'normal',
        'exam.number-version' => 'numéro de version',
        'exam.offline' => 'hors ligne',
        'exam.online' => 'en ligne',
        'exam.opened' => 'ouvert',
        'exam.question-changes' => 'changements de questions',
        'exam.question-exam-dialog' => 'boîte de dialogue des questions d\'examen',
        'exam.questions' => 'questions',
        'exam.send-exam-via-email' => 'envoyer un examenm par e-mail',
        'exam.start-in' => 'commencer dans',
        'exam.status' => 'statut',
        'exam.strict-date' => 'date stricte',
        'exam.type' => 'type',
        'exam.update-exam' => 'mettre à jour l\'examen',
        'exam.update-exam-dialog' => 'mettre à jour la boîte de dialogue de l\'examen',
        'exam.update-exam-success' => 'mettre à jour la réussite de l\'examen',
        'exam.versions' => 'versions',
        'exam.view-marks' => 'voir les notes',
        'exam.view-question' => 'voir la question',
        'exam.wait-data-exam-loading' => 'attendre le chargement de l\'examen des données',
        'exam.wait-exam-creating' => 'attendre la création de l\'examen',
        'exam.wait-exam-upadting' => 'attendre la mise à jour de l\'examen',
        'exam.yes-delete-it' => 'oui, supprimez-le !',
        'header.search-here' => 'rechercher ici...',
        'menu.calendar' => 'calendrier',
        'menu.candidates' => 'candidats',
        'menu.classes' => 'classes',
        'menu.classes-management' => 'gestion des cours',
        'menu.courses' => 'cours',
        'menu.courses-management' => 'gestion des cours',
        'menu.dashboard' => 'tableau de bord',
        'menu.exams' => 'examens',
        'menu.exams-management' => 'gestion des examens',
        'menu.main' => 'principal',
        'candidat.the-format-of-id-classe-should-be-array' => 'le format de la classe d\'id doit être un tableau!',
        'candidat.wait-candidat-updating' => 'attendre la mise à jour du candidat !',
        'classe.last-started-exam' => 'dernier examen a été commencé',
        'classe.name-field-required' => 'champ du nom obligatoire !',
        'classe.number-question' => 'questions sur les nombres',
        'classe.wait-classe-updating' => 'attendre la mise à jour de la classe...',
        'course.wait-course-updating' => 'attendre la mise à jour du cours...'
    ];

    /* ترجمة بالعربية */
    $lang['ar'] = [
        "candidat.actions" => "الإجراءات",
        "candidat.alert-message" => "!رسالة تنبيه",
        "candidat.all-field-required" => "جميع الخانات ضرورية",
        "candidat.are-you-sure-you-gone-delete-that" => "هل أنت متأكد من أنك تريد حذف ذلك!",
        "candidat.candidat-already-exists" => "الطالب موجود سابقا",
        "candidat.candidat-not-found" => "!لم يتم العثور على الطالب",
        "candidat.class" => "القسم",
        "candidat.class-name" => "اسم القسم",
        "candidat.close" => "إغلاق",
        "candidat.could-not-create-class-candidat" => "لا يمكن إنشاء قسم للمرشحين",
        "candidat.could-not-create-this-candidat" => "لا يمكن إنشاء هذا المرشح",
        "candidat.could-not-update-class-candidat" => "لا يمكن تحديث قسم للمرشحين",
        "candidat.could-not-update-information-candidat" => "لا يمكن تحديث معلومات مرشح ",
        "candidat.create" => "إنشاء",
        "candidat.delete" => "حذف",
        "candidat.edit" => "تعديل",
        "candidat.email" => " البريد الإلكتروني",
        "candidat.email-already-exists-for-other-candidat" => "!البريد الإلكتروني موجود  لطالب آخر",
        "candidat.email-already-exists-for-this-class" => "!البريد الإلكتروني موجود سابقا لهذا القسم",
        "candidat.email-must-be-valide" => "يجب أن يكون البريد الإلكتروني صالح",
        "candidat.file-name" => "اسم الملف",
        "candidat.file-not-exists" => "الملف غير موجود",
        "candidat.filter" => "مرشح",
        "candidat.filter-candidat" => "تصفية المرشح",
        "candidat.filter-candidat -اور" => "تصفية حوار المرشح",
        "candidat.first-name" => "الاسم الشخصي",
        "candidat.id" => "الرقم التعريفي",
        "candidat.id-classe" => "الرقم التعريفي للقسم",
        "candidat.id-classe-is-not-array-given" => " الرقم التعريفي ليست مصفوفة معطاة",
        "candidat.import" => "استيراد",
        "candidat.import-candidat" => "دعم حوار المرشح",
        "candidat.import-candidat-dialog" => "نافدة استيراد  ترشيح",
        "candidat.import-candidat-success" => "استيراد مرشح نجاح",
        "candidat.last-name" => "اسم العائلي",
        "candidat.list-candidates" => "قائمة الطلاب",
        "candidat.must-be-valide" => "المرشح يجب أن يكون صحيحًا",
        "candidat.no-cancel" => "!لا ، إلغاء",
        "candidat.required" => "مطلوب",
        "candidat.reset" => "إعادة تعيين",
        "candidat.update-candidat" => "تحديث طالب",
        "candidat.verify" => "تحقق",
        "candidat.verify-id-classe" => " يجب التحقق من الرقم التعريفي للقسم",
        "candidat.wait-candidat-create" => "...انتظر الطالب في طور التسجيل!",
        "candidat.wait-candidat-upadting" => "انتظر الطالب في طور التحديت",
        "candidat.wait-data-candidat-loading" => "انتظر تحميل بيانات الطالب",
        "candidat.year" => "السنة",
        "candidat.yes-delete-it" => "نعم,أريد مسحه!",
        "classe.actions" => "إجراءات",
        "classe.alert-message" => "رسالة تنبيه",
        "classe.all-field-required" => "!جميع الخانات ضرورية",
        "classe.are-you-sure-you-gone-delete-that" => "هل أنت متأكد من حذف ذلك!",
        "classe.avg-note" => "معدل القسم",
        "classe.classe-not-found" => "قسم غير موجود",
        "classe.close" => "حدف",
        "classe.code" => "رمز",
        "classe.code-already-exists" => "رمز هذا القسم موجود سابقا",
        "classe.could-not-create-this-classe" => "لا يمكن إنشاءهدا القسم",
        "classe.could-not-update-this-classe" => "لا يمكن تحديث هدا القسم",
        "classe.create" => "إنشاء",
        "classe.create-classe" => "إنشاء قسم",
        "classe.delete" => "حدف",
        "classe.edit" => "تعديل",
        "classe.id" => "الرقم التعريفي",
        "classe.import-candidat" => "استيراد الطلاب",
        "classe.list-classes" => "لائحة الأقسام",
        "classe.name" => "الإسم",
        "classe.no-cancell" => "لا ; الغاء!",
        "classe.top-1" => "الطالب المتميز",
        "classe.total-candidat" => "مجموع الطلاب",
        "classe.update-classe" => "تحديث القسم",
        "classe.wait-classe-create" => "انتظر إنشاء القسم ...",
        "classe.wait-classe-upadting" => "انتظر تحديث القسم ...",
        "classe.wait-data-classe-loading" => "انتظر تحميل بيانات القسم",
        "classe.year" => "السنة",
        "classe.year-is-not-number " => "السنة ليست رقمًا",
        "classe.yes-delete-it" => "نعم,أريد مسحه",
        "course.actions" => "إجراءات",
        "course.add-question" => "أضف سؤالاً",
        "course.alert-message" => " رسالة تنبيه",
        "course.all-field-required" => "جميع الخانات ضرورية!",
        "course.are-you-sure-you-gone-delete-that" => "هل أنت متأكد أنك تريد حذف ذلك!",
        "course.change-question-course-success" => "تغيير مسار السؤال بنجاح",
        "course.close" =>"اغلاق",
        "course.could-not-create-this-course" => "لا يمكن إنشاء هدا الدرس",
        "course.could-not-create-this-question" => "تعذر إنشاء هذا السؤال",
        "course.could-not-update-this-course" => "لا يمكن تحديث هدا الدرس",
        "course.could-not-update-this-question" => "تعذر تحديث هذا السؤال",
        "course.course-not-found" => "درس غير موجود",
        "course.create" => "إنشاء",
        "course.create-course" => "أنشئ درس",
        "course.create-course-dialog" => "نافدة إنشاء الدرس",
        "course.create-course-success" => "تم إنشاء الدرس بنجاح",
        "course.create-exam" => "أنشئ اختبارًا",
        "course.create-question" => "إنشاء سؤال",
        "course.delete" => "حدف",
        "course.delete-course-success" => "تم مسح الدرس بنجاح",
        "course.edit" => "تعديل",
        "course.id" => "الرقم التعريفي",
        "course.last-started-exam" => "بدأ الاختبار الأخير",
        "course.list-course" => "قائمة الدورات",
        "course.name" => "الأسم",
        "course.name-field-required" => "!الإسم ضروري",
        "course.number-question" => "عدد الأسئلة",
        "course.question-add-option" => "اضافة خيار اخر",
        "course.question-course-dialog" => "نافدة اسئلة الدرس",
        "course.question.delete" => "حذف الأسئلة",
        "course.question.false" => "خطاء",
        "course.question.options" => "خيارات",
        "course.question.title" => "العنوان",
        "course.question.true" => "صحيح",
        "course.question.type" => "الصنف",
        "course.save-changes" => "أحفظ التغيير",
        "course.update-course" => "تحديت الدرس",
        "course.update-course-dialog" => "نافدة تحديث الدرس",
        "course.wait-course-create" => "انتظر إالدرس في طور الانشاء ...",
        "course.wait-course-upadting" =>"انتظر تحديث الدس ...",
        "course.wait-data-course-loading" => "انتظر تحميل بيانات الدرس",
        "course.yes-delete-it" => "نعم,أريد مسحه",
        "exam-candidat.already-closed" => "الامتحان مغلق ",
        "exam-candidat.not-authorized-to-close-this-exam" => "غير مصرّح له بإغلاق هذا الاختبار",
        "exam-candidat.not-found" => "لم يتم العثور على المرشح للاختبار",
        "exam-candidat.not-started-for-closed" => "لم يبدأ المرشح الاختبار للإغلاق",
        "exam.actions" => "الإجراءات",
        "exam.alert-message" => "رسالة تنبيه",
        "exam.all-field-required" => "جميع الحقول ضرورية",
        "exam.are-you-sure-you-gone-delete-that" => "هل أنت متأكد من أنك ذهبت لحذف ذلك!",
        "exam.catch-up" => "اللحاق بالامتحان",
        "exam.change-order" => "تغيير الترتيب",
        "exam.choices" => "اختيارات",
        "exam.class-not-found" => "القسم غير موجود",
        "exam.classes" => "القسم",
        "exam.close" => "إغلاق",
        "exam.closing" => "إغلاق",
        "exam.could-not-create-this-exam" => "تعذر إنشاء هذا الاختبار",
        "exam.could-not-update-this-exam" => "تعذر تحديث هذا الاختبار",
        "exam.cours" => "الدرس",
        "exam.course-not-found" => "الدرس غير موجودة",
        "exam.create" => "إنشاء",
        "exam.create-exam" => "إنشاء اختبار",
        "exam.create-exam-dialog" => "انشاء نافدة الاختبار",
        "exam.create-exam-success" => "تم إنشاء الاختبار بنجاح",
        "exam.delete" => "حذف",
        "exam.delete-exam-success" => "حذف  الاختبار بنجاح",
        "exam.document-type-not-support" => "نوع المستند غير مدعوم",
        "exam.duration" => "المدة",
        "exam.dureation-min" => "المدة (min)",
        "exam.edit" => "تحرير",
        "exam.exam-not-found" => "لم يتم العثور على الاختبار",
        "exam.export.html" => "تصدير html",
        "exam.export.pdf" => "تصدير ملف pdf",
        "exam.export.word" => "تصدير word",
        "exam.field-required" => "حقل الامتحان مطلوبا",
        "exam.info" => "معلومات",
        "exam.list-exams" => "لائحة الامتحانات",
        "exam.message-send-success" => "تم إرسال الرسالة بنجاح",
        "exam.mark" => "نقطة",

        "exam.marks" => "النقط",

        "exam.mark-exam-dialog" => "نافدة نقط الامتحان",

        "exam.export.excel" => " تصديرExcel",
        "exam.nature" => "الطبيعة",
        "exam.no-cancell" => "لا ,الغاء",
        "exam.normal" => "الدورة العادية",
        "exam.number-version" => "إصدار الرقم",
        "exam.offline" => "غير متصل",
        "exam.online" => "عبر الإنترنت",
        "exam.opened" => "مفتوح",
        "exam.question-changes" => "تغيير الأسئلة",
        "exam.question-exam-dialog" => "نافدة أسئلة الاختبار",
        "exam.questions" => "أسئلة",
        "exam.send-exam-via-email" => "أرسل الاختبار عبر البريد الإلكتروني ,",
        "exam.start-in" => "ابدأ في",
        "exam.status" => "الحالة",
        "exam.strict-date" => "وقت محدد",
        "exam.type" => "النوع",
        "exam.update-exam" => "تحديث الامتحان",
        "exam.update-exam-dialog" => "نافدة تحديث الاختبار",
        "exam.update-exam-success" => " تحديث الاختبار بنجاح",
        "exam.versions" => "الإصدارات",
        "exam.view-marks" => "عرض العلامات",
        "exam.view-question" => "عرض السؤال",
        "exam.wait-data-exam-loading" => "انتظر تحميل بيانات الامتحان",
        "exam.wait-exam-create" => "انتظر الاختبار في طور الانشاء",
        "exam.wait-exam-upadting" => "انتظر تحديت الاختبار",
        "exam.yes-delete-it" => "نعم احذفها!",
        "header.search-here" => "ابحث هنا...",
        "menu.calendar" => "تقويم",
        "menu.candidates" => "مرشحين",
        "menu.classes" => "الفصول",
        "menu.classes-management" => "إدارة الفصول",
        "menu.courses" => "الدورات",
        "menu.courses-management" => "إدارة الدروس",
        "menu.dashboard" => "لوحة التحكم",
        "menu.exams" => "الامتحانات",
        "menu.exams-management" => "إدارة الامتحانات",
        "menu.main" => "الرئيسية",
        "candidat.wait-candidat-updating" => "...انتظر الطالب في طور التحديت ",
        "classe.last-started-exam" => "بدأ الإختبار الأخير",
        "classe.name-field-required" => "!الإسم ضروري",
        "classe.number-question" => "عدد الأسئلة",
        "classe.wait-classe-updating" => "...انتظر القسم في طور المعالجة",
        "course.wait-course-updating" => "...انتظر الدرس في طور المعالجة",
        "course.list-courses" => "قائمة الدورات",
        "course.update-course-success" => "تم تحديث الدرس بنجاح",
        "course.wait-course-creating" => "...انتظر الدرس في طور الإنشاء",
        "course.are-you-sure-you-went-delete-that" => "هل تريد فعلا مسحه",
        "course.no-cancel" => "لا,إلغاء",
        "classe.year-is-not-number" => "السنة يجب أن تكون عبارة عن أعداد",
        "classe.create-classe-dialog" => "نافدة إنشاء قسم",
        "classe.update-classe-dialog" => "نافدة تحديث قسم",
        "classe.update-classe-success" => "تم تحديث القسم بنجاح",
        "classe.create-classe-success" => "تم إنشاء القسم بنجاح",
        "classe.delete-classe-success" => "تم حدف القسم بنجاح",
        "classe.wait-classe-creating" => "...انتظر قسم في طور الإنشاء",
        "classe.are-you-sure-you-went-delete-that" => "!هل تريد فعلا مسحه",
        "classe.no-cancel" => "!لا,إلغاء",
        "candidat.id-candidat" => "الرقم التعريفي للطالب",
        "candidat.are-you-sure-you-went-delete-that" => "هل تريد فعلا مسحه!",
        "candidat.create-candidat-dialog" => "نافدة إنشاء الطالب",
        "candidat.update-candidat-dialog" => "نافدة تحديث الطالب",
        "candidat.create-candidat" => "إضافة طالب",
        "candidat.the-format-of-id-classe-should-be-array" => "!الرقم التعريفي للقسم يجب أن يكون على شكل جدول",
        "candidat.create-candidat-success" => "تم إنشاء المرشح بنجاح",
        "candidat.update-candidat-success" => "تم تحديث الطالب بنجاح",
        "candidat.delete-candidat-success" => "تم حدف الطالب بنجاح"
    ];

    return $lang[current_lang()][$key] ?? $key;
}