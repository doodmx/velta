export default class QuestionOption {

    constructor(id, option, credits, is_right_one) {

        this.id = id;
        this.option = option;
        this.credits = credits;
        this.is_right_one = is_right_one;
    }


    setIsRightOne(is_right_one) {
        this.is_right_one = is_right_one
    }

    setCredits(credits) {
        this.credits = credits;
    }
}
