package com.lab9v1.model;

import java.util.ArrayList;

public interface ImmutableDocument {
    public ArrayList<ImmutableHarmonica> getHarmonics();

    public void register(DocumentObserver observer);
}
