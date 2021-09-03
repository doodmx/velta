export default class Quiz {

    constructor(id, name, briefing, credits, creditsToApprove, questions) {

        this.id = id;
        this.name = name;
        this.briefing = briefing;
        this.total_credits = credits;
        this.credits_to_approve = creditsToApprove;
        this.questions = questions
    }


    setId(id) {

        if ($.observable !== undefined) {
            $.observable(this).setProperty('id', id);
        } else {
            this.id = id;
        }
    }

    setName(name) {

        if ($.observable !== undefined) {
            $.observable(this).setProperty('name', name);
        } else {
            this.name = name;
        }
    }

    setBriefing(briefing) {
        if ($.observable !== undefined) {
            $.observable(this).setProperty('briefing', briefing);

        } else {
            this.briefing = briefing;
        }
    }

    setCredits(credits) {
        if ($.observable !== undefined) {
            $.observable(this).setProperty('total_credits', parseInt(credits));

        } else {
            this.total_credits = parseInt(credits);
        }
    }

    setCreditsToApprove(credits) {
        if ($.observable !== undefined) {
            $.observable(this).setProperty('credits_to_approve', parseInt(credits));

        } else {
            this.credits_to_approve = parseInt(credits);
        }
    }

    setQuestions(questions) {

        if ($.observable !== undefined) {
            $.observable(this.questions).refresh(questions);

        } else {
            this.questions = [...questions];
        }

    }

    addQuestion(question) {

        if ($.observable !== undefined) {
            $.observable(this.questions).insert(this.questions.length, question);

        } else {
            this.questions.push(question);
        }

    }

    removeQuestion(index) {

        if ($.observable !== undefined) {
            $.observable(this.questions).remove(index);

        } else {
            this.questions.splice(index, 1);
        }


    }

}

