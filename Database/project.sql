-- Create Students Table
CREATE TABLE Students (
  student_id INT PRIMARY KEY,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  date_of_birth DATE,
  gender VARCHAR(10),
  contact_number VARCHAR(20),
  address VARCHAR(100)
);

-- Create Teachers Table
CREATE TABLE Teachers (
  teacher_id INT PRIMARY KEY,
  first_name VARCHAR(50),
  last_name VARCHAR(50),
  date_of_birth DATE,
  gender VARCHAR(10),
  contact_number VARCHAR(20),
  address VARCHAR(100)
);

-- Create Classes Table
CREATE TABLE Classes (
  class_id INT PRIMARY KEY,
  class_name VARCHAR(50)
);

-- Create Subjects Table
CREATE TABLE Subjects (
  subject_id INT PRIMARY KEY,
  subject_name VARCHAR(50)
);

-- Create Class_Subjects Table
CREATE TABLE Class_Subjects (
  class_id INT,
  subject_id INT,
  FOREIGN KEY (class_id) REFERENCES Classes(class_id),
  FOREIGN KEY (subject_id) REFERENCES Subjects(subject_id),
  PRIMARY KEY (class_id, subject_id)
);

-- Create Enrollments Table
CREATE TABLE Enrollments (
  student_id INT,
  class_id INT,
  enrollment_date DATE,
  FOREIGN KEY (student_id) REFERENCES Students(student_id),
  FOREIGN KEY (class_id) REFERENCES Classes(class_id),
  PRIMARY KEY (student_id, class_id)
);

-- Create Attendance Table
CREATE TABLE Attendance (
  attendance_id INT PRIMARY KEY,
  student_id INT,
  class_id INT,
  date DATE,
  status VARCHAR(20),
  FOREIGN KEY (student_id) REFERENCES Students(student_id),
  FOREIGN KEY (class_id) REFERENCES Classes(class_id)

);

-- Create Grades Table
CREATE TABLE Grades (
  grade_id INT PRIMARY KEY,
  student_id INT,
  subject_id INT,
  class_id INT,
  grade FLOAT,
  FOREIGN KEY (student_id) REFERENCES Students(student_id),
  FOREIGN KEY (subject_id) REFERENCES Subjects(subject_id),
  FOREIGN KEY (class_id) REFERENCES Classes(class_id)

);

-- Create Users Table
CREATE TABLE Users (
  user_id INT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(50),
  role VARCHAR(20)
);
