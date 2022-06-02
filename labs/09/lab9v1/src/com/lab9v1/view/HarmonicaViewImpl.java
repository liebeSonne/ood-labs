package com.lab9v1.view;

import javax.swing.*;

public class HarmonicaViewImpl implements HarmonicaView{
    @Override
    public HarmonicaData getNewHarmonica() {
        AddNewHarmonic dialog = new AddNewHarmonic();
        dialog.pack();
        dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
        dialog.setVisible(true);
        return dialog.getHarmonica();
    }
}
