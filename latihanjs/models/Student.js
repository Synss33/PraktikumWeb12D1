import Person from './Person.js';

export default class Student extends Person {
    constructor (name, age, nim, major) {
        super(name, age);
        this.nim = nim;
        this.major = major;
    }

    study() {
        console.log('${this.nama} (NIM : ${this.nim}) belajar di jurusan ${this.major}');
    }
}