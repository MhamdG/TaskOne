import { Component, OnInit } from '@angular/core';
import { StudentService } from 'src/app/services/student.service';

import {NgbCalendar, NgbDate, NgbDateStruct} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-add-student',
  templateUrl: './add-student.component.html',
  styleUrls: ['./add-student.component.css'],
})
export class AddStudentComponent implements OnInit {
  model: NgbDateStruct;

  student = {
    first_name: '',
    last_name: '',
    class: '',
    date_of_birth: Date,
  };
  submitted = false;
  constructor(private studentService: StudentService,private calendar: NgbCalendar) {}
  isDisabled = (date: NgbDate, current: {month: number, year: number}) => date.month !== current.month;
  isWeekend = (date: NgbDate) =>  this.calendar.getWeekday(date) >= 6;


  ngOnInit(): void {}

  saveStudent() {
    const data = {
      first_name: this.student.first_name,
      last_name: this.student.last_name,
      class: this.student.class,
      date_of_birth: this.student.date_of_birth,
    };

    this.studentService.create(data).subscribe(
      (response) => {
        console.log(response);
        this.submitted = true;
      },
      (error) => {
        console.log(error);
      }
    );
  }

  newStudent() {
    this.submitted = false;
    this.student = {
      first_name: '',
      last_name: '',
      class: '',
      date_of_birth: Date,
    };
  }
}
