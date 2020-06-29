import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators} from '@angular/forms';
import { ClassesValidator } from './classes.validator';

import { ClassesService } from 'src/app/services/classes.service';

@Component({
  selector: 'app-add-classes',
  templateUrl: './add-classes.component.html',
  styleUrls: ['./add-classes.component.css'],
})
export class AddClassesComponent implements OnInit {

  form = new FormGroup({
    code: new FormControl('', [Validators.required, ClassesValidator.cannotContainSpace]),
    name: new FormControl('', Validators.required),
    status: new FormControl('', Validators.required),
    max_students: new FormControl('', Validators.required)
    
  });


  classes = {
    code: '',
    name: '',
    max_students: '',
    status: '',
    description: '',
  };
  submitted = false;

  constructor(private classesService: ClassesService) {}

  get f(){
    return this.form.controls;
  }

  submit(){
    console.log(this.form.value);

    this.saveClasses();
  }

  ngOnInit(): void {}
  

  saveClasses() {
    const data = {
      code: this.classes.code,
      name: this.classes.name,
      max_students: this.classes.max_students,
      status: this.classes.status,
      description: this.classes.description,
    };

    this.classesService.create(data).subscribe(
      (response) => {
        console.log(response);
        this.submitted = true;
      },
      (error) => {
        console.log(error);
      }
    );
  }



  newClasses() {
    this.submitted = false;
    this.classes = {
      code: '',
      name: '',
      max_students: '',
      status: '',
      description: '',
    };
  }
}
