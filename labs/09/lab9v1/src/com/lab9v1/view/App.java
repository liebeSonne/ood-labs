package com.lab9v1.view;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;

import javax.swing.*;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Optional;

public class App {
    private JButton addNewButton;
    private JButton deleteSelectedButton;
    private JTextField amplitudeTextField;
    private JList harmonicsList;
    private JTabbedPane tabbedPane;
    private JTable table;
    private JRadioButton sinRadioButton;
    private JRadioButton cosRadioButton;
    private JTextField frequencyTextField;
    private JTextField phaseTextField;
    private JPanel mainPanel;
    private JPanel selectedHarmonicaPanel;
    private JPanel listPanel;
    private ButtonGroup formulaButtonGroup;

    private MainController controller;
    private Optional<Harmonica> selectedHarmonica;

    public App(MainController controller) {
        this.controller = controller;

        this.drawList();
        this.drawSelectedHarmonica();

        this.bindBtnEvents();
        this.bindListEvents();
    }

    public JPanel getMainPanel() {
        return mainPanel;
    }

    private void bindBtnEvents() {
        addNewButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onAddNewButton();
            }
        });
        deleteSelectedButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onDeleteSelectedButton();
            }
        });
    }

    private void onAddNewButton() {
        Harmonica harmonica = new Harmonica(1, Formula.SIN, 1, 0);
        JDialog dialog = new AddNewHarmonic(controller, harmonica);
        dialog.pack();
        dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
        dialog.setVisible(true);
     }

     private void onDeleteSelectedButton() {

     }

     private void drawList() {
         DefaultListModel data = new DefaultListModel();
         this.controller.getDocument().getHarmonics().forEach(harmonica -> {
             data.addElement(harmonica);
         });
         this.harmonicsList.setModel(data);
     }

     private void bindListEvents () {
         harmonicsList.addListSelectionListener(new ListSelectionListener() {
             @Override
             public void valueChanged(ListSelectionEvent e) {
                 Harmonica selected = (Harmonica) ((JList<?>)e.getSource()).getSelectedValue();
                 selectedHarmonica = Optional.ofNullable(selected);

                 drawSelectedHarmonica();
             }
         });
     }

     private void drawSelectedHarmonica() {
         setData(selectedHarmonica);
    }

    private void setData(Optional<Harmonica> obj) {
        if (obj != null && obj.isPresent()) {
            Harmonica data = obj.get();
            amplitudeTextField.setText(Double.toString(data.getAmplitude()));
            frequencyTextField.setText(Double.toString(data.getFrequency()));
            phaseTextField.setText(Double.toString(data.getPhase()));

            formulaButtonGroup.clearSelection();
            switch (data.getFormula()) {
                case COS -> cosRadioButton.setSelected(true);
                case SIN -> sinRadioButton.setSelected(true);
            }
        } else {
            amplitudeTextField.setText("");
            frequencyTextField.setText("");
            phaseTextField.setText("");
            formulaButtonGroup.clearSelection();
            sinRadioButton.setSelected(true);
        }
    }

    private void getData(Harmonica data) {
        data.setAmplitude(Double.parseDouble(amplitudeTextField.getText()));
        data.setFrequency(Double.parseDouble(frequencyTextField.getText()));
        data.setPhase(Double.parseDouble(phaseTextField.getText()));
        if (formulaButtonGroup.getSelection().equals(cosRadioButton)) {
            data.setFormula(Formula.COS);
        } else {
            data.setFormula(Formula.SIN);
        }
    }
}
