package com.lab9v1.model;

public enum Formula {
    COS {
        @Override
        public String toString () {
            return "cos";
        }
    },
    SIN {
        @Override
        public String toString () {
            return "sin";
        }
    }
}
