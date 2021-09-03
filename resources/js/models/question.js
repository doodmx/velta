export class Question {


    constructor(id, question, credits, type, options) {

        this.id = id;
        this.name = question;
        this.credits = credits;
        this.type = type;
        this.options = options
    }

    setOptions(options) {

        if ($.observable !== undefined)
            $.observable(this.options).refresh(options);
        else
            this.options = [...options];
    }

    addOption(option) {

        if ($.observable !== undefined)
            $.observable(this.options).insert(option);
        else
            this.options.push(option);

    }

    deleteOption(index) {

        if ($.observable !== undefined)
            $.observable(this.options).remove(index);
        else
            this.options.splice(index,1);


    }
}


export const questionTypes = [
    {
        name: 'radio',
        description: 'Radio'
    },
    {
        name: 'checkbox',
        description: 'Casillas de Verificación'
    }
];
